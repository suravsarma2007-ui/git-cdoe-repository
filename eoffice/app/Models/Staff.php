<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staff';

    protected $fillable = [
        'emp_id',
        'name',
        'designation',
        'staff_type',
        'discipline',
        'subject',
        'official_email',
        'personal_email',
        'contact',
        'doj',
        'address',
    ];

    protected $casts = [
        'doj' => 'date',
    ];

    protected $dates = ['deleted_at'];

      public static function getNameById($id)
    {
        $staff = self::find($id);
        return $staff ? $staff->name : null;
    }
}
