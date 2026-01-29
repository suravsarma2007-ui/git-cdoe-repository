<?php

namespace App\Http\Controllers;

use App\Models\Eslm;
use App\Models\Program;
use App\Models\Paper;
use App\Models\Staff;
use App\Models\DailyRecordVideo;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class DailyRecordVideoController extends Controller
{
    // To show the form for creating a new daily record video form
    public function create()
    {
        $records=DailyRecordVideo::orderBy('created_at','desc')->get();
        return view('daily_record_video.create');
        
    }

     public function index()
    {
        $records=DailyRecordVideo::orderBy('created_at','desc')->get();

        // 🔹 Prepare lookup arrays (ID => Name)
           $programs = Program::pluck('program_name', 'id');
           $modules  = Module::pluck('moduleNo', 'slno');
           $papers   = Paper::pluck('paper_name', 'id');
           $staffs   = Staff::pluck('name', 'id');
          return view('daily_record_video.index', compact('records', 'programs', 
          'modules', 'papers', 'staffs'));


    }

    public function destroy($id)
    {
        $record = DailyRecordVideo::findOrFail($id);
        $record->delete();
        return redirect()->back()->with('success', 'Daily Record Video data deleted successfully.');
    }

    // To store the daily record video data
    public function store(Request $request)
    {
        
        // Handle the form submission logic here    
        $validate=$request->validate([
            'program_id'=>'required|exists:programs,id',
            'module_id'=>'required|exists:modules,slno',
            'paper_id'=>'required|exists:papers,id',
            'faculty_id'=>'required|exists:staff,id',            
            'video_no'=>'required|integer',           
            'recording_status'=>'required|string|max:50',
            'recodring_date'=>'nullable|date',            
            'editing_status'=>'required|string|max:50',
            'editor_emp_id'=>'required|exists:staff,id',            
            'ppt_status'=>'required|string|max:50',            
            'ppt_submittion_date'=>'nullable|date',            
            'eslm_status'=>'required|string|max:50',            
            'eslm_submittion_date'=>'nullable|date',            
            'eslm_web_upload_status'=>'required|string|max:50',            
            'eslm_web_upload_date'=>'nullable|date',
        ]);
        DailyRecordVideo::create($validate); // It should be controller
        return redirect()->back()->with('success', 'Daily Record Video data saved successfully.');
    }


public function edit($id)
{
    $record = DailyRecordVideo::findOrFail($id);
    return view('daily_record_video.edit', compact('record'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'program_id' => 'required',
        'module_id' => 'required',
        'paper_id' => 'required',
        'faculty_id' => 'required',
        'video_no' => 'required|integer',
        'recording_status' => 'required|string|max:50',
        'recording_date' => 'nullable|date',
        'editing_status' => 'required|string|max:50',
        'editor_emp_id' => 'required',
        'ppt_status' => 'required',
        'ppt_submission_date' => 'nullable|date',
        'eslm_status' => 'required',
        'eslm_submission_date' => 'nullable|date',
        'eslm_web_upload_status' => 'required',
        'eslm_web_upload_date' => 'nullable|date',
    ]);

    DailyRecordVideo::findOrFail($id)->update($validated);

    return redirect()->route('daily_record_video.index')
        ->with('success', 'Record updated successfully');   
    }



}
