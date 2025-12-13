<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use App\Models\Program;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    // ...existing code...
    /**
     * Display a listing of papers with search.
     */
    public function index(Request $request)
    {
        $query = Paper::with('program');

        // Search by paper name, codes, or program name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('paper_name', 'like', '%' . $search . '%')
                  ->orWhere('codes', 'like', '%' . $search . '%')
                  ->orWhereHas('program', function($q) use ($search) {
                      $q->where('program_name', 'like', '%' . $search . '%');
                  });
            });
        }

        // (Removed duplicate byProgram method; see correct version at end of class)

        $papers = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('paper.index', compact('papers'));
    }

    /**
     * Show the form for creating a new paper.
     */
    public function create()
    {
        $programs = Program::orderBy('program_name')->get();
        return view('paper.create', compact('programs'));
    }

    /**
     * Store a newly created paper in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'codes' => 'required|string|max:50',
            'paper_name' => 'required|string|max:255',
            'module' => 'nullable|string|max:100',
            'semester' => 'required|integer|min:1|max:8',
            'years' => 'required|integer|min:2025|max:20025',
        ]);

        Paper::create($validated);

        return redirect()->route('paper.index')->with('success', 'Paper created successfully!');
    }

    /**
     * Show the form for editing the specified paper.
     */
    public function edit(Paper $paper)
    {
        $programs = Program::orderBy('program_name')->get();
        return view('paper.edit', compact('paper', 'programs'));
    }

    /**
     * Update the specified paper in database.
     */
    public function update(Request $request, Paper $paper)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'codes' => 'required|string|max:50',
            'paper_name' => 'required|string|max:255',
            'module' => 'nullable|string|max:100',
            'semester' => 'required|integer|min:1|max:8',
            'years' => 'required|integer|min:2025|max:20025',
        ]);

        $paper->update($validated);

        return redirect()->route('paper.index')->with('success', 'Paper updated successfully!');
    }

    /**
     * Show confirmation before deleting.
     */
    public function destroy(Paper $paper)
    {
        return view('paper.delete', compact('paper'));
    }

    /**
     * Actually delete the paper.
     */
    public function confirmDelete(Paper $paper)
    {
        $paper->delete();
        return redirect()->route('paper.index')->with('success', 'Paper deleted successfully!');
    }

    /**
     * Display papers report with filters.
     */
    public function report(Request $request)
    {
        $query = Paper::with('program');

        // Filter by program
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // Filter by semester
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        // Filter by years
        if ($request->filled('years')) {
            $query->where('years', $request->years);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('paper_name', 'like', '%' . $search . '%')
                  ->orWhere('codes', 'like', '%' . $search . '%');
            });
        }

        $papers = $query->orderBy('program_id')->orderBy('semester')->paginate(15);
        $programs = Program::orderBy('program_name')->get();

        return view('paper.report', compact('papers', 'programs'));
    }

    /**
     * Export papers to CSV.
     */
    public function exportCsv(Request $request)
    {
        $query = Paper::with('program');

        // Apply same filters as report
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('years')) {
            $query->where('years', $request->years);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('paper_name', 'like', '%' . $search . '%')
                  ->orWhere('codes', 'like', '%' . $search . '%');
            });
        }

        $papers = $query->orderBy('program_id')->orderBy('semester')->get();

        // Create CSV header
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="papers_' . date('Y-m-d_H-i-s') . '.csv"',
        ];

        $callback = function() use ($papers) {
            $file = fopen('php://output', 'w');
            
            // Write header row
            fputcsv($file, ['SL No', 'Program Name', 'Program ID', 'Paper Code', 'Paper Name', 'Module', 'Semester', 'Year']);

            // Write data rows
            foreach ($papers as $index => $paper) {
                fputcsv($file, [
                    $index + 1,
                    $paper->program->program_name ?? '-',
                    $paper->program->program_id ?? '-',
                    $paper->codes,
                    $paper->paper_name,
                    $paper->module ?? '-',
                    $paper->semester,
                    $paper->years,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export papers to Excel (using CSV with Excel headers).
     */
    public function exportExcel(Request $request)
    {
        $query = Paper::with('program');

        // Apply same filters as report
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('years')) {
            $query->where('years', $request->years);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('paper_name', 'like', '%' . $search . '%')
                  ->orWhere('codes', 'like', '%' . $search . '%');
            });
        }

        $papers = $query->orderBy('program_id')->orderBy('semester')->get();

        // Create Excel header
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="papers_' . date('Y-m-d_H-i-s') . '.xlsx"',
        ];

        $callback = function() use ($papers) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM for Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Write header row
            fputcsv($file, ['SL No', 'Program Name', 'Program ID', 'Paper Code', 'Paper Name', 'Module', 'Semester', 'Year']);

            // Write data rows
            foreach ($papers as $index => $paper) {
                fputcsv($file, [
                    $index + 1,
                    $paper->program->program_name ?? '-',
                    $paper->program->program_id ?? '-',
                    $paper->codes,
                    $paper->paper_name,
                    $paper->module ?? '-',
                    $paper->semester,
                    $paper->years,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Return JSON list of papers for a given program (or all papers if no program specified).
     */
    public function byProgram($programId = null)
    {
        $query = Paper::with('program');
        if ($programId) {
            $query->where('program_id', $programId);
        }

        $papers = $query->orderBy('paper_name')->get();

        $result = $papers->map(function($p) {
            return [
                'id' => $p->id,
                'paper_name' => $p->paper_name,
                'codes' => $p->codes,
                'program_id' => $p->program->id ?? null,
                'program_name' => $p->program->program_name ?? null,
            ];
        });

        return response()->json($result);
    }
}
