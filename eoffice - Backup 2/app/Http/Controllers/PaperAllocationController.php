<?php

namespace App\Http\Controllers;

use App\Models\PaperAllocation;
use App\Models\Paper;
use App\Models\Staff;
use App\Models\Program;
use Illuminate\Http\Request;

class PaperAllocationController extends Controller
{
    public function index(Request $request)
    {
        $query = PaperAllocation::with(['paper.program', 'staff']);

        // Filter by program (paper -> program)
        if ($request->filled('program_id')) {
            $query->whereHas('paper', function($q) use ($request) {
                $q->where('program_id', $request->program_id);
            });
        }

        // Filter by semester
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->whereHas('paper', function($q) use ($s) {
                $q->where('paper_name', 'like', "%$s%")
                  ->orWhere('codes', 'like', "%$s%");
            })->orWhereHas('staff', function($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('official_email', 'like', "%$s%");
            });
        }

        $allocations = $query->orderBy('date', 'desc')->paginate(15);
        $programs = Program::orderBy('program_name')->get();

        return view('paper_allocation.index', compact('allocations', 'programs'));
    }

    public function create()
    {
        $papers = Paper::with('program')->orderBy('paper_name')->get();
        // Only list staff with staff_type 'Faculty' in the faculty dropdown
        $staff = Staff::where('staff_type', 'Faculty')->orderBy('name')->get();
        $programs = \App\Models\Program::orderBy('program_name')->get();
        return view('paper_allocation.create', compact('papers', 'staff', 'programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paper_id' => 'required|exists:papers,id',
            'emp_id' => 'required|exists:staff,id',
            'module_no' => 'nullable|string|max:20',
            'semester' => 'required|integer|min:1|max:8',
            'year' => 'required|digits:4',
            'week_no' => 'required|integer|min:1|max:53',
            'date' => 'required|date',
        ]);

        PaperAllocation::create($validated);

        return redirect()->route('paper_allocation.index')->with('success', 'Allocation created.');
    }

    public function edit(PaperAllocation $paper_allocation)
    {
        $papers = Paper::with('program')->orderBy('paper_name')->get();
        // Only list staff with staff_type 'Faculty' in the faculty dropdown
        $staff = Staff::where('staff_type', 'Faculty')->orderBy('name')->get();
        $programs = \App\Models\Program::orderBy('program_name')->get();
        return view('paper_allocation.edit', ['allocation' => $paper_allocation, 'papers' => $papers, 'staff' => $staff, 'programs' => $programs]);
    }

    public function update(Request $request, PaperAllocation $paper_allocation)
    {
        $validated = $request->validate([
            'paper_id' => 'required|exists:papers,id',
            'emp_id' => 'required|exists:staff,id',
            'module_no' => 'nullable|string|max:20',
            'semester' => 'required|integer|min:1|max:8',
            'year' => 'required|digits:4',
            'week_no' => 'required|integer|min:1|max:53',
            'date' => 'required|date',
        ]);

        $paper_allocation->update($validated);

        return redirect()->route('paper_allocation.index')->with('success', 'Allocation updated.');
    }

    public function destroy(PaperAllocation $paper_allocation)
    {
        return view('paper_allocation.delete', ['allocation' => $paper_allocation]);
    }

    public function confirmDelete(PaperAllocation $paper_allocation)
    {
        $paper_allocation->delete();
        return redirect()->route('paper_allocation.index')->with('success', 'Allocation deleted.');
    }

    public function exportCsv(Request $request)
    {
        $query = PaperAllocation::with(['paper.program', 'staff']);

        // Filter by program
        if ($request->filled('program_id')) {
            $query->whereHas('paper', function($q) use ($request) {
                $q->where('program_id', $request->program_id);
            });
        }

        if ($request->filled('paper_id')) {
            $query->where('paper_id', $request->paper_id);
        }
        if ($request->filled('emp_id')) {
            $query->where('emp_id', $request->emp_id);
        }
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $rows = $query->orderBy('date')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="paper_allocations_' . date('Y-m-d_H-i-s') . '.csv"',
        ];

        $callback = function() use ($rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['SL No', 'Program Name', 'Paper Name', 'Paper Code', 'Faculty Name', 'Module No', 'Semester', 'Year', 'Week No', 'Date']);

            foreach ($rows as $i => $r) {
                fputcsv($file, [
                    $i + 1,
                    $r->paper->program->program_name ?? '-',
                    $r->paper->paper_name ?? '-',
                    $r->paper->codes ?? '-',
                    $r->staff->name ?? '-',
                    $r->module_no ?? '-',
                    $r->semester,
                    $r->year,
                    $r->week_no,
                    $r->date ? $r->date->toDateString() : '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportExcel(Request $request)
    {
        $query = PaperAllocation::with(['paper.program', 'staff']);

        // Filter by program
        if ($request->filled('program_id')) {
            $query->whereHas('paper', function($q) use ($request) {
                $q->where('program_id', $request->program_id);
            });
        }

        if ($request->filled('paper_id')) {
            $query->where('paper_id', $request->paper_id);
        }
        if ($request->filled('emp_id')) {
            $query->where('emp_id', $request->emp_id);
        }
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $rows = $query->orderBy('date')->get();

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="paper_allocations_' . date('Y-m-d_H-i-s') . '.xlsx"',
        ];

        $callback = function() use ($rows) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['SL No', 'Program Name', 'Paper Name', 'Paper Code', 'Faculty Name', 'Module No', 'Semester', 'Year', 'Week No', 'Date']);

            foreach ($rows as $i => $r) {
                fputcsv($file, [
                    $i + 1,
                    $r->paper->program->program_name ?? '-',
                    $r->paper->paper_name ?? '-',
                    $r->paper->codes ?? '-',
                    $r->staff->name ?? '-',
                    $r->module_no ?? '-',
                    $r->semester,
                    $r->year,
                    $r->week_no,
                    $r->date ? $r->date->toDateString() : '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
