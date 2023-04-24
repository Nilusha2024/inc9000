<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDepartment extends Model
{
    protected $table = 'job_department';

    public $fillable = ['id', 'job_id', 'department_id', 'department_status', 'start_date', 'end_date'];
}
