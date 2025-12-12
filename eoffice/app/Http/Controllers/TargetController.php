<?php
namespace App\Http\Controllers;

use App\Models\Target;
use App\Models\Staff;
use App\Models\Program;
use App\Models\Paper;
use App\Models\module as Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TargetController extends Controller
{
    /**
     * Get unique module_id values from targetreport for filter combo.
     */
    protected function getModuleOptionsFromTargetReport()
    {
        return \DB::table('targetreport')
            ->whereNotNull('module_id')
            ->distinct()
            ->pluck('module_id')
            ->sort()
            ->values();
    }
    public function index(Request $request)
    {
        $query = Target::with(['staff','program','paper','module','week']);
        if ($request->filled('module_id')) $query->where('module_id', $request->module_id);
        if ($request->filled('week_id')) $query->where('week_id', $request->week_id);
        if ($request->filled('program_id')) $query->where('program_id', $request->program_id);
        if ($request->filled('paper_id')) $query->where('paper_id', $request->paper_id);
        if ($request->filled('emp_id')) $query->where('emp_id', $request->emp_id);
        if ($request->filled('status')) $query->where('status', $request->status);

        $targets = $query->orderByDesc('from_date')->paginate(15);

        $faculties = Staff::where('staff_type', 'faculty')->get();
        $programs = Program::all();
        $papers = Paper::all();
        $modules = Module::all();
        $weeks = DB::table('week')->get();

        return view('target.index', compact('targets','faculties','programs','papers','modules','weeks'));
    }

    public function create()
    {
        $faculties = Staff::where('staff_type', 'faculty')->get();
        $programs = Program::all();
        $papers = collect();
        $modules = Module::all();
        $weeks = DB::table('week')->get();
        return view('target.create', compact('faculties','programs','papers','modules','weeks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'emp_id' => 'required|exists:staff,id',
            'program_id' => 'required|exists:programs,id',
            'paper_id' => 'required|exists:papers,id',
            'module_id' => 'required|exists:modules,slno',
            'week_id' => 'required|exists:week,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'status' => 'required|in:Pending,Completed',
            'remark' => 'nullable|string',
        ]);

        // Duplicate check: Paper + Module + Week + From Date
        $exists = Target::where('paper_id', $validated['paper_id'])
            ->where('module_id', $validated['module_id'])
            ->where('week_id', $validated['week_id'])
            ->whereDate('from_date', $validated['from_date'])
            ->exists();
        if ($exists) {
            return back()
                ->withErrors(['duplicate' => 'Duplicate entry: Target already exists for the selected Paper, Module, Week, and From Date.'])
                ->withInput();
        }

        Target::create($validated);
        return redirect()->route('target.index')->with('success', 'Target created successfully.');
    }

    public function edit(Target $target)
    {
        $faculties = Staff::where('staff_type', 'faculty')->get();
        $programs = Program::all();
        $papers = Paper::where('program_id', $target->program_id)->get();
        $modules = Module::all();
        $weeks = DB::table('week')->get();
        return view('target.edit', compact('target','faculties','programs','papers','modules','weeks'));
    }

    public function update(Request $request, Target $target)
    {
        $validated = $request->validate([
            'emp_id' => 'required|exists:staff,id',
            'program_id' => 'required|exists:programs,id',
            'paper_id' => 'required|exists:papers,id',
            'module_id' => 'required|exists:modules,slno',
            'week_id' => 'required|exists:week,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'status' => 'required|in:Pending,Completed',
            'remark' => 'nullable|string',
        ]);

        // Duplicate check on update (exclude current record)
        $exists = Target::where('paper_id', $validated['paper_id'])
            ->where('module_id', $validated['module_id'])
            ->where('week_id', $validated['week_id'])
            ->whereDate('from_date', $validated['from_date'])
            ->where('slno', '!=', $target->slno)
            ->exists();
        if ($exists) {
            return back()
                ->withErrors(['duplicate' => 'Duplicate entry: Target already exists for the selected Paper, Module, Week, and From Date.'])
                ->withInput();
        }

        $target->update($validated);
        return redirect()->route('target.index')->with('success', 'Target updated successfully.');
    }

    public function destroy(Target $target)
    {
        $target->delete();
        return redirect()->route('target.index')->with('success', 'Target deleted successfully.');
    }

    public function exportCsv(Request $request)
    {
        $query = \DB::table('targetreport')
            ->select([
                'slno',
                'emp_id',
                'name',
                'program_id',
                'program',
                'paper_id',
                'PaperName',
                'module_id',
                'week_id',
                'from_date',
                'to_date',
                'status',
                'remark',
                'created_at',
                'updated_at',
                'ESLM',
                'ElsmSubmittedDate',
                'PPT',
                'PPTSubmittedDate',
                'VideoRequired',
                'VedioSubmitted',
                'VidoeSubmittedDate',
            ]);

        if ($request->filled('week_id')) $query->where('week_id', $request->week_id);
        if ($request->filled('module_id')) $query->where('module_id', $request->module_id);
        if ($request->filled('paper_id')) $query->where('paper_id', $request->paper_id);
        if ($request->filled('emp_id')) $query->where('emp_id', $request->emp_id);
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('from_date')) $query->where('from_date', '>=', $request->from_date);
        if ($request->filled('to_date')) $query->where('to_date', '<=', $request->to_date);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="target_final_report_' . now()->format('Ymd_His') . '.csv"',
        ];
        $callback = function() use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Sl No','Emp ID','Name','Program ID','Program','Paper ID','Paper Name','Module ID','Week ID','From Date','To Date','Status','Remark','Created At','Updated At','ESLM','ESLM Submitted Date','PPT','PPT Submitted Date','Video Required','Vedio Submitted','Vidoe Submitted Date'
            ]);
            $query->orderByDesc('to_date')->chunk(300, function($chunk) use ($handle) {
                foreach ($chunk as $r) {
                    fputcsv($handle, [
                        $r->slno,
                        $r->emp_id,
                        $r->name,
                        $r->program_id,
                        $r->program,
                        $r->paper_id,
                        $r->PaperName,
                        $r->module_id,
                        $r->week_id,
                        $r->from_date,
                        $r->to_date,
                        $r->status,
                        $r->remark,
                        $r->created_at,
                        $r->updated_at,
                        $r->ESLM,
                        $r->ElsmSubmittedDate,
                        $r->PPT,
                        $r->PPTSubmittedDate,
                        $r->VideoRequired,
                        $r->VedioSubmitted,
                        $r->VidoeSubmittedDate,
                    ]);
                }
            });
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // AJAX helper: get papers by program
    public function papersByProgram(Request $request)
    {
        $programId = $request->get('program_id');
        if (!$programId) return response()->json([]);
        $papers = Paper::where('program_id', $programId)->select('id','paper_name','codes')->orderBy('paper_name')->get();
        return response()->json($papers);
    }

    // Final consolidated report with inline edit for remark/status
    public function finalReport(Request $request)
    {
        $query = DB::table('targetreport')
            ->select([
                'slno',
                'emp_id',
                'name',
                'program_id',
                'program',
                'paper_id',
                'PaperName',
                'module_id',
                'week_id',
                'from_date',
                'to_date',
                'status',
                'remark',
                'created_at',
                'updated_at',
                'ESLM',
                'ElsmSubmittedDate',
                'PPT',
                'PPTSubmittedDate',
                'VideoRequired',
                'VedioSubmitted',
                'VidoeSubmittedDate',
            ]);

        // Restore filters for report (map filter names to correct columns)
        if ($request->filled('program')) $query->where('program', $request->program);
        if ($request->filled('PaperName')) $query->where('PaperName', $request->PaperName);
        if ($request->filled('name')) $query->where('name', $request->name);
        if ($request->filled('module_id')) $query->where('module_id', $request->module_id);
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('from_date')) $query->where('from_date', '>=', $request->from_date);
        if ($request->filled('to_date')) $query->where('to_date', '<=', $request->to_date);

        $rows = $query->orderByDesc('to_date')->paginate(15);

        // Get unique filter options from targetreport
        $facultyOptions = DB::table('targetreport')->whereNotNull('name')->distinct()->pluck('name')->sort()->values();
        $programOptions = DB::table('targetreport')->whereNotNull('program')->distinct()->pluck('program')->sort()->values();
        $paperOptions = DB::table('targetreport')->whereNotNull('PaperName')->distinct()->pluck('PaperName')->sort()->values();
        $moduleOptions = $this->getModuleOptionsFromTargetReport();
        $statusOptions = DB::table('targetreport')->whereNotNull('status')->distinct()->pluck('status')->sort()->values();

        return view('target.final_report', compact('rows','facultyOptions','programOptions','paperOptions','moduleOptions','statusOptions'));
    }

    public function finalReportCsv(Request $request)
    {

        $base = DB::table('targetreport')
            ->select([
                'slno',
                'emp_id',
                'name',
                'program_id',
                'program',
                'paper_id',
                'PaperName',
                'module_id',
                'week_id',
                'from_date',
                'to_date',
                'status',
                'remark',
                'created_at',
                'updated_at',
                'ESLM',
                'ElsmSubmittedDate',
                'PPT',
                'PPTSubmittedDate',
                'VideoRequired',
                'VedioSubmitted',
                'VidoeSubmittedDate',
            ]);

        if ($request->filled('week_id')) $base->where('week_id', $request->week_id);
        if ($request->filled('module_id')) $base->where('module_id', $request->module_id);
        if ($request->filled('paper_id')) $base->where('paper_id', $request->paper_id);
        if ($request->filled('emp_id')) $base->where('emp_id', $request->emp_id);
        if ($request->filled('status')) $base->where('status', $request->status);
        if ($request->filled('from_date')) $base->where('from_date', '>=', $request->from_date);
        if ($request->filled('to_date')) $base->where('to_date', '<=', $request->to_date);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="target_final_report_' . now()->format('Ymd_His') . '.csv"',
        ];
        $callback = function() use ($base) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Sl No','Emp ID','Name','Program ID','Program','Paper ID','Paper Name','Module ID','Week ID','From Date','To Date','Status','Remark','Created At','Updated At','ESLM','ESLM Submitted Date','PPT','PPT Submitted Date','Video Required','Vedio Submitted','Vidoe Submitted Date'
            ]);
            $base->orderByDesc('to_date')->chunk(300, function($chunk) use ($handle) {
                foreach ($chunk as $r) {
                    fputcsv($handle, [
                        $r->slno,
                        $r->emp_id,
                        $r->name,
                        $r->program_id,
                        $r->program,
                        $r->paper_id,
                        $r->PaperName,
                        $r->module_id,
                        $r->week_id,
                        $r->from_date,
                        $r->to_date,
                        $r->status,
                        $r->remark,
                        $r->created_at,
                        $r->updated_at,
                        $r->ESLM,
                        $r->ElsmSubmittedDate,
                        $r->PPT,
                        $r->PPTSubmittedDate,
                        $r->VideoRequired,
                        $r->VedioSubmitted,
                        $r->VidoeSubmittedDate,
                    ]);
                }
            });
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Inline update of remark and status in final report
    public function updateRemarkStatus(Request $request, $slno)
    {
        $data = $request->validate([
            'remark' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
        ]);
        DB::table('target_table')->where('slno', $slno)->update($data);
        $msg = 'Data updated. Status: ' . ($data['status'] ?? '');
        return back()->with('success', $msg);
    }
}
