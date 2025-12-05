<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppt extends Model
{
    use HasFactory;

    protected $table = 'ppt';

    protected $fillable = [
        'paper',
        'emp_id',
        'program_id',
        'module_no',
        'status',
        'no_of_ppt',
        'screen_recording',
        'remarks',
        'total',
        'date_of_submit',
        'ppt_file_link',
    ];

    // Relationships
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper', 'paper_name');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'emp_id', 'emp_id');
    }
}
