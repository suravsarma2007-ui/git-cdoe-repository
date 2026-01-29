<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperAllocationView extends Model
{
    //

     protected $table = 'paperallocationview';

    protected $fillable = [
        'paper_id',
        'paper_name',
        'emp_id',
        'faculty_name',
        'Module_no',
        'semester',
        'year'
    ];

}
