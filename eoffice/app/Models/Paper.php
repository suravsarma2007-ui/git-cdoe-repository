<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paper extends Model
{
    use SoftDeletes;

    protected $table = 'papers';

    protected $fillable = [
        'program_id',
        'codes',
        'paper_name',
        'module',
        'semester',
        'years',
    ];

    protected $casts = [
        'semester' => 'integer',
        'years' => 'integer',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Relationship: Paper belongs to Program
     */
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }
}
