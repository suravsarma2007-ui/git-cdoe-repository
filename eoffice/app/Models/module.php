<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class module extends Model
{
    //
    // Table now has only slno (PK) and moduleNo
    protected $table = 'modules';
    protected $primaryKey = 'slno';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'moduleNo',
    ];
}