<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoRecordingSchedule extends Model
{
    protected $table = 'video_recording_schedule';

    protected $fillable = [
        'emp_id','program_id','paper_id','module_id','week_id',
        'record_date','from_time','to_time','status','remark'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'emp_id', 'id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id', 'id');
    }

    public function module()
    {
        // modules table uses 'slno' as primary key
        return $this->belongsTo(module::class, 'module_id', 'slno');
    }

    public function week()
    {
        return $this->belongsTo(\App\Models\Week::class, 'week_id', 'id');
    }
}
