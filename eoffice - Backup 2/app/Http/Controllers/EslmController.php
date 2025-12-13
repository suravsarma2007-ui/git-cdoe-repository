<?php

namespace App\Http\Controllers;

use App\Models\Eslm;
use App\Models\Program;
use App\Models\Paper;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EslmController extends Controller
{
    public function index(Request $request)
    {
        // Filtering
        $query = Eslm::query()->with(['program', 'paper', 'staff']);
        if ($request->filled('program_id')) {
            $query->where('id', $request->program_id);
        }
        if ($request->filled('codes')) {
            $query->where('id', $request->codes);
        }
        if ($request->filled('module_no')) {
            $query->where('module_no', $request->module_no);
        }
        if ($request->filled('emp_id')) {
            $query->where('id', $request->emp_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $eslms = $query->paginate(15);
        $programs = Program::all();
        $papers = Paper::all();
        $staff = Staff::all();
        return view('eslm.index', compact('eslms', 'programs', 'papers', 'staff'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('eslm.create', compact('programs'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'program_id' => 'required|exists:programs,id',
        'paper_id'   => 'required|exists:papers,id',
        'emp_id'     => 'required|exists:staff,emp_id',
        'module_no'  => 'required|integer|min:1|max:20',
        'status'     => 'nullable|string|max:50',
        'remark'     => 'nullable|string',
        'block'      => 'nullable|string|max:100',
    ]);

    $validated['date_of_submit'] = now()->toDateString();

    // Handle file upload
    if ($request->hasFile('file_upload_link')) {

        // Get program & paper using IDs directly
        $program = Program::find($validated['program_id']);
        $paper   = Paper::find($validated['paper_id']);

        // Sanitize names for folder/file
        $programName = $program ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $program->program_name) : 'unknown_program';
        $semester    = $paper ? $paper->semester : 'unknown_semester';
        $paperName   = $paper ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $paper->paper_name) : 'unknown_paper';

        $moduleNo = $validated['module_no'];

        // Folder structure uses paper_id → paper details
        $folder = "$programName/$semester/$paperName/Module$moduleNo";

        // Create directories recursively
        $segments = explode('/', $folder);
        $path = '';
        foreach ($segments as $segment) {
            $path = ltrim($path . '/' . $segment, '/');
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }
        }

        // Save file with paper name
        $ext = $request->file('file_upload_link')->getClientOriginalExtension();
        $fileName = $paperName . '.' . $ext;

        $validated['file_upload_link'] =
            $request->file('file_upload_link')->storeAs($folder, $fileName, 'public');
    }

        // Save directly with paper_id
        $validated['paper_code'] = $validated['paper_id']; // Ensure paper_code is set to paper_id
        unset($validated['paper_id']); // Remove paper_id from validated data
        Eslm::create($validated); // Create the record

    return redirect()->route('eslm.index')->with('success', 'Record added successfully.');
}


    public function edit(Eslm $eslm)
    {
        $programs = Program::all();
        $papers = Paper::all();
        return view('eslm.edit', compact('eslm', 'programs', 'papers'));
    }

    public function update(Request $request, Eslm $eslm)
{
    $validated = $request->validate([
        'program_id' => 'required|exists:programs,program_id',
        'codes' => 'required|exists:papers,codes',   // paper selected
        'emp_id' => 'required|exists:staff,emp_id',
        'module_no' => 'required|integer|min:1|max:20',
        'status' => 'nullable|string|max:50',
        'remark' => 'nullable|string',
        'block' => 'nullable|string|max:100',
    ]);

    // ----------------------------
    // FIX: Correctly store paper_code
    // ----------------------------
    $validated['paper_code'] = $validated['codes']; // save selected paper code
    unset($validated['codes']); // remove 'codes' after mapping

    // ----------------------------
    // FILE UPLOAD LOGIC
    // ----------------------------
    if ($request->hasFile('file_upload_link')) {

        $program = Program::where('program_id', $validated['program_id'])->first();
        $paper = Paper::where('codes', $validated['paper_code'])->first();

        $programName = $program ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $program->program_name) : 'unknown_program';
        $semester = $paper ? $paper->semester : 'unknown_semester';
        $paperName = $paper ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $paper->paper_name) : 'unknown_paper';
        $moduleNo = $validated['module_no'] ?? 'module';

        $folder = "$programName/$semester/$paperName/Module$moduleNo";

        // ensure folder structure
        $segments = explode('/', $folder);
        $path = '';
        foreach ($segments as $segment) {
            $path = ltrim($path . '/' . $segment, '/');
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }
        }

        // file name based on paper name
        $ext = $request->file('file_upload_link')->getClientOriginalExtension();
        $fileName = $paperName . '.' . $ext;

        $validated['file_upload_link'] =
            $request->file('file_upload_link')->storeAs($folder, $fileName, 'public');
    }

    // update record
    $eslm->update($validated);

    return redirect()->route('eslm.index')->with('success', 'Record updated successfully.');
}


    public function destroy(Eslm $eslm)
    {
        $eslm->delete();
        return redirect()->route('eslm.index')->with('success', 'Record deleted successfully.');
    }

    public function report(Request $request)
    {
        // Same as index, but for report view
        // Ensure paper_id is available in report filters and views
        $query = Eslm::query()->with(['program', 'paper', 'staff']);
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('paper_id')) {
            $query->where('paper_code', $request->paper_id);
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
        $eslms = $query->paginate(15);
        $programs = Program::all();
        $papers = Paper::all();
        $staff = Staff::all();
        return view('eslm.report', compact('eslms', 'programs', 'papers', 'staff'));
    }

    public function exportCsv(Request $request)
    {
        $query = Eslm::query()->with(['program', 'paper', 'staff']);
        // Apply filters as in index
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('codes')) {
            $query->where('codes', $request->codes);
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
        $eslms = $query->get();
        $filename = 'eslm_report_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        $columns = ['SlNo', 'Program Name', 'Paper Name', 'Faculty Name', 'Module No', 'Status', 'DateOfSubmit', 'File Link', 'Remark', 'Block'];
        $callback = function() use ($eslms, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($eslms as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->program?->program_name,
                    $row->paper?->paper_name,
                    $row->staff?->name,
                    $row->module_no,
                    $row->status,
                    $row->date_of_submit,
                    $row->file_upload_link,
                    $row->remark,
                    $row->block,
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);
        $path = $request->file('csv_file')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $header = array_map('trim', array_shift($rows));
        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            Eslm::create([
                'program_id' => $data['Program ID'],
                'paper_code' => $data['Paper ID'], // Store paper_id in paper_code
                'emp_id' => $data['emp_id'],
                'module_no' => $data['ModuleNo'],
                'status' => $data['Status'] ?? null,
                'date_of_submit' => $data['DateOfSubmit'] ?? now()->toDateString(),
                // 'file_upload_link' => $data['file_upload_link'] ?? null, // removed file upload
                'remark' => $data['Remark'] ?? null,
                'block' => $data['Block'] ?? null,
            ]);
        }
        return redirect()->route('eslm.index')->with('success', 'CSV imported successfully.');
    }

    // Show form to upload files for each module
    public function moduleUploadForm(Eslm $eslm)
    {
        return view('eslm.module_upload', compact('eslm'));
    }

    // Handle upload of files for each module
    public function moduleUpload(Request $request, Eslm $eslm)
    {
        $files = $request->file('module_files', []);
        $uploaded = [];
        foreach ($files as $moduleNo => $file) {
            if ($file) {
                $path = $file->store('eslm_module_uploads');
                $uploaded[$moduleNo] = $path;
            }
        }
        // You may want to store $uploaded in a related table or as JSON in the eslm record
        // Example: $eslm->update(['module_files' => json_encode($uploaded)]);
        return redirect()->route('eslm.index')->with('success', 'Module files uploaded successfully.');
    }
}
