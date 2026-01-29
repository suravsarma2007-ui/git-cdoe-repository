<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRecordVideo extends Model
{
    //
     //use SoftDeletes;
    use HasFactory;
    protected $table = 'daily_record_video_table';
    protected $fillable = [
        'program_id',
        'module_id',
        'paper_id',
        'video_no',
        'emp_id',
        'recording_status',
        'record_date',
        'editing_status',
        'editor_emp_id',
        'ppt_status',
        'ppt_submittion_date',
        'eslm_status',
        'eslm_submittion_date',
        'eslm_web_uploaded_status',
        'eslm_web_uploaded_date',
        'create_at',
        'updated_at',
        // Add other fields as necessary
    ];
}
