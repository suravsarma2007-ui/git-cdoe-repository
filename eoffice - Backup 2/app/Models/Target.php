<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'target_table';
    protected $primaryKey = 'slno';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'emp_id','program_id','paper_id','module_id','week_id',
        'from_date','to_date','status','remark'
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
        return $this->belongsTo(module::class, 'module_id', 'slno');
    }

    public function week()
    {
        return $this->belongsTo(Week::class, 'week_id', 'id');
    }
}
