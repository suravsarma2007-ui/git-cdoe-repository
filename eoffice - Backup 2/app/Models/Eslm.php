<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eslm extends Model
{
    protected $fillable = [
        'program_id',
        'paper_code',
        'emp_id',
        'module_no',
        'status',
        'date_of_submit',
        'file_upload_link',
        'remark',
        'block',
        'created_at',
        'updated_at',
    ];

    // ESLM belongs to Program (by program_id)
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    // ESLM belongs to Paper (by paper_code to id)
    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_code', 'id');
    }

    // ESLM belongs to Staff (by emp_id)
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'emp_id', 'id');
    }
}
