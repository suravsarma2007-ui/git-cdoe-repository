<?php

namespace App\Http\Controllers;

use App\Models\VideoRecordingSchedule;
use App\Models\Staff;
use App\Models\Program;
use App\Models\Paper;
use App\Models\module as Module;
use Illuminate\Http\Request;

class VideoRecordingScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = VideoRecordingSchedule::query()->with(['staff','program','paper','module','week']);
        if ($request->filled('module_id')) $query->where('module_id', $request->module_id);
        if ($request->filled('week_id')) $query->where('week_id', $request->week_id);
        if ($request->filled('program_id')) $query->where('program_id', $request->program_id);
        if ($request->filled('emp_id')) $query->where('emp_id', $request->emp_id);
        if ($request->filled('record_date')) $query->whereDate('record_date', $request->record_date);
        $schedules = $query->orderByDesc('record_date')->paginate(15);

        $faculties = Staff::where('staff_type', 'faculty')->get();
        $programs = Program::all();
        $papers = Paper::all();
        $modules = Module::all();
        $weeks = \DB::table('week')->get();

        return view('video_schedule.index', compact('schedules','faculties','programs','papers','modules','weeks'));
    }

    public function create()
    {
        $faculties = Staff::where('staff_type', 'faculty')->get();
        $programs = Program::all();
        // No papers until program selected; front-end will load dynamically
        $papers = collect();
        $modules = Module::all();
        $weeks = \DB::table('week')->get();
        return view('video_schedule.create', compact('faculties','programs','papers','modules','weeks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'emp_id' => 'required|exists:staff,id',
            'program_id' => 'required|exists:programs,id',
            'paper_id' => 'required|exists:papers,id',
            'module_id' => 'required|exists:modules,slno',
            'week_id' => 'required|exists:week,id',
            'record_date' => 'required|date',
            'from_time' => 'required',
            'to_time' => 'required',
            'status' => 'nullable|string|max:50',
            'remark' => 'nullable|string',
        ]);

        VideoRecordingSchedule::create($validated);
        return redirect()->route('video_schedule.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(VideoRecordingSchedule $video_schedule)
    {
        $faculties = Staff::where('staff_type', 'faculty')->get();
        $programs = Program::all();
        // Preload papers for the selected program
        $papers = Paper::where('program_id', $video_schedule->program_id)->get();
        $modules = Module::all();
        $weeks = \DB::table('week')->get();
        return view('video_schedule.edit', compact('video_schedule','faculties','programs','papers','modules','weeks'));
    }

    // AJAX: Get papers by selected program
    public function papersByProgram(Request $request)
    {
        $programId = $request->get('program_id');
        if (!$programId) {
            return response()->json([]);
        }
        $papers = Paper::where('program_id', $programId)->select('id','paper_name')->orderBy('paper_name')->get();
        return response()->json($papers);
    }

    // Note: Module dropdown is no longer filtered by Paper/Program

    public function update(Request $request, VideoRecordingSchedule $video_schedule)
    {
        $validated = $request->validate([
            'emp_id' => 'required|exists:staff,id',
            'program_id' => 'required|exists:programs,id',
            'paper_id' => 'required|exists:papers,id',
            'module_id' => 'required|exists:modules,slno',
            'week_id' => 'required|exists:week,id',
            'record_date' => 'required|date',
            'from_time' => 'required',
            'to_time' => 'required',
            'status' => 'nullable|string|max:50',
            'remark' => 'nullable|string',
        ]);

        $video_schedule->update($validated);
        return redirect()->route('video_schedule.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(VideoRecordingSchedule $video_schedule)
    {
        $video_schedule->delete();
        return redirect()->route('video_schedule.index')->with('success', 'Schedule deleted successfully.');
    }

    public function exportCsv(Request $request)
    {
        $query = VideoRecordingSchedule::query()->with(['staff','program','paper','module','week']);
        if ($request->filled('module_id')) $query->where('module_id', $request->module_id);
        if ($request->filled('week_id')) $query->where('week_id', $request->week_id);
        if ($request->filled('program_id')) $query->where('program_id', $request->program_id);
        if ($request->filled('emp_id')) $query->where('emp_id', $request->emp_id);
        if ($request->filled('record_date')) $query->whereDate('record_date', $request->record_date);

        $filename = 'video_recording_schedule_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Faculty Name','Program','Paper Name','Module No','Week No','Record Date','From Time','To Time','Status','Remark']);
            $query->chunk(200, function($rows) use ($handle) {
                foreach ($rows as $row) {
                    fputcsv($handle, [
                        $row->staff?->name,
                        $row->program?->program_name,
                        $row->paper?->paper_name,
                        $row->module?->moduleNo ?? $row->module?->moduleno ?? $row->module?->module_no,
                        $row->week?->week_no,
                        $row->record_date,
                        $row->from_time,
                        $row->to_time,
                        $row->status,
                        $row->remark,
                    ]);
                }
            });
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
