<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eslm extends Model
{
    use HasFactory;

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
    ];

    // Relationships
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_code', 'codes');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'emp_id', 'emp_id');
    }
}
