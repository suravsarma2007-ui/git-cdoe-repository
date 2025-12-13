<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicSession extends Model
{
    //
    use SoftDeletes;
    protected $table = 'academic_sessions';
    protected $fillable = [
        'session_id',
        'session_name',
        'session_year',
      
    ];
}
