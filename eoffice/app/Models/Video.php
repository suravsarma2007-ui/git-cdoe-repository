<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'paper_id',
        'emp_id',
        'program_id',
        'module_no',
        'semester',
        'total_videos_required',
        'total_videos_done',
        'total_videos_edited',
        'uploaded_videos',
        'remark',
        'upload_date',
        'month',
        'year',
        'final_status',
    ];

    protected $casts = [
        'semester' => 'integer',
        'upload_date' => 'date',
        'month' => 'integer',
        'year' => 'integer',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'emp_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
