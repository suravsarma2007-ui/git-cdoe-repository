<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperAllocation extends Model
{
    protected $table = 'paper_allocations';

    protected $fillable = [
        'paper_id',
        'emp_id',
        'module_no',
        'semester',
        'year',
        'week_no',
        'date',
    ];

    protected $casts = [
        'semester' => 'integer',
        'week_no' => 'integer',
        'date' => 'date',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'emp_id');
    }
}
