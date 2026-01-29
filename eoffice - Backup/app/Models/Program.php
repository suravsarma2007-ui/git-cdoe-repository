<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $table = 'programs';

    protected $fillable = [
        'program_name',
        'program_id',
        'session_year',
        'program_code',
    ];

    protected $dates = ['deleted_at'];
}
