<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\Program;
use App\Models\Paper;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PptController extends Controller
{
    public function index(Request $request)
    {
        $query = Ppt::query()->with(['program', 'paper', 'staff']);
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('paper_id')) {
            $query->where('paper_id', $request->paper_id);
        }
        if ($request->filled('module_no')) {
            $query->where('module_no', $request->module_no);
        }
        if ($request->filled('emp_id')) {
            $query->where('emp_id', $request->emp_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('semester')) {
            $query->whereHas('paper', function($subQ) use ($request) {
                $subQ->where('semester', $request->semester);
            });
        }
        $ppts = $query->paginate(15);
        $programs = Program::all();
        $papers = Paper::all();
        $staff = Staff::all();
        return view('ppt.index', compact('ppts', 'programs', 'papers', 'staff'));
    }

    public function create()
    {
        $programs = Program::all();
        $papers = \App\Models\Paper::with('program')->get();
        $staff = \App\Models\Staff::where('staff_type', 'faculty')->get();
        return view('ppt.create', compact('programs', 'papers', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'paper_id' => 'required|exists:papers,id',
            'emp_id' => 'required|exists:staff,id',
            'module_no' => 'required|integer|min:1|max:20',
            'status' => 'nullable|string|max:50',
            'no_of_ppt' => 'nullable|integer',
            'screen_recording' => 'nullable|string|max:100',
            'remarks' => 'nullable|string',
            'total' => 'nullable|integer',
        ]);

        // Prevent duplicate entry for same paper_id, module_no, emp_id, and same month/year
        $date = $validated['date_of_submit'] ?? now()->toDateString();
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $exists = \App\Models\Ppt::where('paper_id', $validated['paper_id'])
            ->where('module_no', $validated['module_no'])
            ->where('emp_id', $validated['emp_id'])
            ->whereMonth('date_of_submit', $month)
            ->whereYear('date_of_submit', $year)
            ->exists();
        if ($exists) {
            return back()->withErrors(['paper_id' => 'A record for this Paper, Module No, Faculty, and Month/Year already exists.'])->withInput();
        }
        $validated['date_of_submit'] = now()->toDateString();
        // Handle file upload
        if ($request->hasFile('ppt_file_link')) {
            $program = Program::find($validated['program_id']);
            $paper = Paper::find($validated['paper_id']);
            $programName = $program ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $program->program_name) : 'unknown_program';
            $semester = $paper ? $paper->semester : 'unknown_semester';
            $paperName = $paper ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $paper->paper_name) : 'unknown_paper';
            $moduleNo = $validated['module_no'] ?? 'module';
            $folder = "$programName/$semester/Module$moduleNo/$paperName";
            $segments = explode('/', $folder);
            $path = '';
            foreach ($segments as $segment) {
                $path = ltrim($path . '/' . $segment, '/');
                if (!Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->makeDirectory($path);
                }
            }
            $ext = $request->file('ppt_file_link')->getClientOriginalExtension();
            $fileName = $paperName . '.' . $ext;
            $validated['ppt_file_link'] = $request->file('ppt_file_link')->storeAs($folder, $fileName, 'public');
        }
        // Remove setting 'paper' field, store only paper_id
        Ppt::create($validated);
        return redirect()->route('ppt.index')->with('success', 'Record added successfully.');
    }

    public function edit(Ppt $ppt)
    {
        $programs = Program::all();
        $papers = \App\Models\Paper::with('program')->get();
        $staff = \App\Models\Staff::where('staff_type', 'faculty')->get();
        return view('ppt.edit', compact('ppt', 'programs', 'papers', 'staff'));
    }

    public function update(Request $request, Ppt $ppt)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'paper_id' => 'required|exists:papers,id',
            'emp_id' => 'required|exists:staff,id',
            'module_no' => 'required|integer|min:1|max:20',
            'status' => 'nullable|string|max:50',
            'no_of_ppt' => 'nullable|integer',
            'screen_recording' => 'nullable|string|max:100',
            'remarks' => 'nullable|string',
            'total' => 'nullable|integer',
        ]);

        // Prevent duplicate entry for same paper_id, module_no, emp_id, and same month/year (excluding current record)
        $date = $validated['date_of_submit'] ?? now()->toDateString();
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $exists = \App\Models\Ppt::where('paper_id', $validated['paper_id'])
            ->where('module_no', $validated['module_no'])
            ->where('emp_id', $validated['emp_id'])
            ->whereMonth('date_of_submit', $month)
            ->whereYear('date_of_submit', $year)
            ->where('id', '!=', $ppt->id)
            ->exists();
        if ($exists) {
            return back()->withErrors(['paper_id' => 'A record for this Paper, Module No, Faculty, and Month/Year already exists.'])->withInput();
        }
        // Handle file upload
        if ($request->hasFile('ppt_file_link')) {
            $program = Program::find($validated['program_id']);
            $paper = Paper::find($validated['paper_id']);
            $programName = $program ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $program->program_name) : 'unknown_program';
            $semester = $paper ? $paper->semester : 'unknown_semester';
            $paperName = $paper ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $paper->paper_name) : 'unknown_paper';
            $moduleNo = $validated['module_no'] ?? 'module';
            $folder = "$programName/$semester/Module$moduleNo/$paperName";
            $segments = explode('/', $folder);
            $path = '';
            foreach ($segments as $segment) {
                $path = ltrim($path . '/' . $segment, '/');
                if (!Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->makeDirectory($path);
                }
            }
            $ext = $request->file('ppt_file_link')->getClientOriginalExtension();
            $fileName = $paperName . '.' . $ext;
            $validated['ppt_file_link'] = $request->file('ppt_file_link')->storeAs($folder, $fileName, 'public');
        }
        $ppt->update($validated);
        return redirect()->route('ppt.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(Ppt $ppt)
    {
        $ppt->delete();
        return redirect()->route('ppt.index')->with('success', 'Record deleted successfully.');
    }

    public function exportCsv(Request $request)
    {
        $query = Ppt::query()->with(['program', 'paper', 'staff']);
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('paper')) {
            $query->where('paper', $request->paper);
        }
        if ($request->filled('module_no')) {
            $query->where('module_no', $request->module_no);
        }
        if ($request->filled('emp_id')) {
            $query->where('emp_id', $request->emp_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $ppts = $query->get();
        $filename = 'ppt_report_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        $columns = ['SlNo', 'Program Name', 'Semester', 'Paper Name', 'Faculty Name', 'Module No', 'Status', 'No of PPT', 'Screen Recording', 'Remarks', 'Total', 'DateOfSubmit', 'ppt_file_link'];
        $staffList = \App\Models\Staff::all();
        $callback = function() use ($ppts, $columns, $staffList) {
            // Clear output buffer to prevent corrupt CSV download
            if (ob_get_level()) {
                ob_end_clean();
            }
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($ppts as $row) {
                // Find faculty name by emp_id
                $faculty = $staffList->firstWhere('id', $row->emp_id) ?? $staffList->firstWhere('emp_id', $row->emp_id);
                $facultyName = $faculty ? $faculty->name . ' (' . $faculty->emp_id . ')' : $row->emp_id;
                $paperName = $row->paper?->paper_name ?? $row->paper;
                $semester = $row->paper?->semester ?? '';
                fputcsv($file, [
                    $row->id,
                    $row->program?->program_name,
                    $semester,
                    $paperName,
                    $facultyName,
                    $row->module_no,
                    $row->status,
                    $row->no_of_ppt,
                    $row->screen_recording,
                    $row->remarks,
                    $row->total,
                    $row->date_of_submit,
                    $row->ppt_file_link,
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
