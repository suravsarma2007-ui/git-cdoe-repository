<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Paper;
use App\Models\Staff;
use App\Models\Program;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::with(['paper.program', 'staff', 'program']);

        // Search filters
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('paper_id')) {
            $query->where('paper_id', $request->paper_id);
        }
        if ($request->filled('emp_id')) {
            $query->where('emp_id', $request->emp_id);
        }
        if ($request->filled('module_no')) {
            $query->where('module_no', 'like', '%' . $request->module_no . '%');
        }
        if ($request->filled('date_from')) {
            $query->whereDate('upload_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('upload_date', '<=', $request->date_to);
        }
        if ($request->filled('final_status')) {
            $query->where('final_status', $request->final_status);
        }

        $videos = $query->orderBy('upload_date', 'desc')->paginate(15);
        $programs = Program::orderBy('program_name')->get();
        $papers = Paper::orderBy('paper_name')->get();
        $staff = Staff::where('staff_type', 'Faculty')->orderBy('name')->get();

        return view('video.index', compact('videos', 'programs', 'papers', 'staff'));
    }

    public function create()
    {
        $programs = Program::orderBy('program_name')->get();
        $staff = Staff::where('staff_type', 'Faculty')->orderBy('name')->get();
        return view('video.create', compact('programs', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'paper_id' => 'required|exists:papers,id',
            'emp_id' => 'required|exists:staff,id',
            'module_no' => 'nullable|string|max:50',
            'semester' => 'required|integer|min:1|max:8',
            'total_videos_required' => 'required|integer|min:0',
            'total_videos_done' => 'required|integer|min:0',
            'total_videos_edited' => 'required|integer|min:0',
            'uploaded_videos' => 'required|integer|min:0',
            'remark' => 'nullable|string|max:1000',
            'upload_date' => 'required|date',
            'final_status' => 'nullable|string|in:Pending,In Progress,Completed,On Hold',
        ]);

        // Check for duplicate: same paper, staff, and module combination
        $duplicate = Video::where('paper_id', $validated['paper_id'])
            ->where('emp_id', $validated['emp_id'])
            ->where('module_no', $validated['module_no'])
            ->exists();

        if ($duplicate) {
            return redirect()->back()->withInput()->with('error', 'Duplicate entry! This combination of Paper, Staff, and Module already exists.');
        }

        // Auto-fill month and year
        $date = \Carbon\Carbon::parse($validated['upload_date']);
        $validated['month'] = $date->month;
        $validated['year'] = $date->year;

        Video::create($validated);

        return redirect()->route('video.index')->with('success', 'Video entry created.');
    }

    public function edit(Video $video)
    {
        $programs = Program::orderBy('program_name')->get();
        $staff = Staff::where('staff_type', 'Faculty')->orderBy('name')->get();
        return view('video.edit', compact('video', 'programs', 'staff'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'paper_id' => 'required|exists:papers,id',
            'emp_id' => 'required|exists:staff,id',
            'module_no' => 'nullable|string|max:50',
            'semester' => 'required|integer|min:1|max:8',
            'total_videos_required' => 'required|integer|min:0',
            'total_videos_done' => 'required|integer|min:0',
            'total_videos_edited' => 'required|integer|min:0',
            'uploaded_videos' => 'required|integer|min:0',
            'remark' => 'nullable|string|max:1000',
            'upload_date' => 'required|date',
            'final_status' => 'nullable|string|in:Pending,In Progress,Completed,On Hold',
        ]);

        // Check for duplicate: same paper, staff, and module combination (excluding current record)
        $duplicate = Video::where('paper_id', $validated['paper_id'])
            ->where('emp_id', $validated['emp_id'])
            ->where('module_no', $validated['module_no'])
            ->where('id', '!=', $video->id)
            ->exists();

        if ($duplicate) {
            return redirect()->back()->withInput()->with('error', 'Duplicate entry! This combination of Paper, Staff, and Module already exists.');
        }

        $date = \Carbon\Carbon::parse($validated['upload_date']);
        $validated['month'] = $date->month;
        $validated['year'] = $date->year;

        $video->update($validated);

        return redirect()->route('video.index')->with('success', 'Video entry updated.');
    }

    public function destroy(Video $video)
    {
        return view('video.delete', compact('video'));
    }

    public function confirmDelete(Video $video)
    {
        $video->delete();
        return redirect()->route('video.index')->with('success', 'Video entry deleted.');
    }

    public function report(Request $request)
    {
        $query = Video::with(['paper.program', 'staff', 'program']);

        // Filters
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $videos = $query->orderBy('upload_date', 'desc')->paginate(15);
        $programs = Program::orderBy('program_name')->get();

        return view('video.report', compact('videos', 'programs'));
    }

    // Export methods with filtering
    private function getFilteredVideos(Request $request)
    {
        $query = Video::with(['paper.program', 'staff', 'program']);

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        if ($request->filled('format') && $request->format === 'weekly') {
            // Weekly: filter by week number if needed
        }

        return $query->orderBy('upload_date')->get();
    }

    public function exportCsv(Request $request)
    {
        $videos = $this->getFilteredVideos($request);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="videos_' . date('Y-m-d_H-i-s') . '.csv"',
        ];

        $callback = function() use ($videos) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['SL No', 'Program Name', 'Staff Name', 'Paper Name', 'Module No', 'Semester', 'Videos Required', 'Videos Done', 'Videos Edited', 'Uploaded', 'Upload Date', 'Month', 'Year', 'Remark', 'Final Status']);

            foreach ($videos as $i => $v) {
                fputcsv($file, [
                    $i + 1,
                    $v->program->program_name ?? '-',
                    $v->staff->name ?? '-',
                    $v->paper->paper_name ?? '-',
                    $v->module_no ?? '-',
                    $v->semester,
                    $v->total_videos_required,
                    $v->total_videos_done,
                    $v->total_videos_edited,
                    $v->uploaded_videos,
                    $v->upload_date?->toDateString() ?? '-',
                    $v->month,
                    $v->year,
                    $v->remark ?? '-',
                    $v->final_status ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportExcel(Request $request)
    {
        $videos = $this->getFilteredVideos($request);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="videos_' . date('Y-m-d_H-i-s') . '.xlsx"',
        ];

        $callback = function() use ($videos) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['SL No', 'Program Name', 'Staff Name', 'Paper Name', 'Module No', 'Semester', 'Videos Required', 'Videos Done', 'Videos Edited', 'Uploaded', 'Upload Date', 'Month', 'Year', 'Remark', 'Final Status']);

            foreach ($videos as $i => $v) {
                fputcsv($file, [
                    $i + 1,
                    $v->program->program_name ?? '-',
                    $v->staff->name ?? '-',
                    $v->paper->paper_name ?? '-',
                    $v->module_no ?? '-',
                    $v->semester,
                    $v->total_videos_required,
                    $v->total_videos_done,
                    $v->total_videos_edited,
                    $v->uploaded_videos,
                    $v->upload_date?->toDateString() ?? '-',
                    $v->month,
                    $v->year,
                    $v->remark ?? '-',
                    $v->final_status ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * AJAX endpoint: return semesters for a given program
     */
    public function semestersByProgram($programId = null)
    {
        if (!$programId) {
            return response()->json([]);
        }

        $papers = Paper::where('program_id', $programId)->distinct()->pluck('semester')->sort()->values();

        return response()->json($papers);
    }

    /**
     * AJAX endpoint: return papers for a given program and semester
     */
    public function papersByProgramSemester($programId = null, $semester = null)
    {
        $query = Paper::with('program');

        if ($programId) {
            $query->where('program_id', $programId);
        }
        if ($semester) {
            $query->where('semester', $semester);
        }

        $papers = $query->orderBy('paper_name')->get()->map(function($p) {
            return [
                'id' => $p->id,
                'paper_name' => $p->paper_name,
                'codes' => $p->codes,
                'program_id' => $p->program->id ?? null,
            ];
        });

        return response()->json($papers);
    }
}
