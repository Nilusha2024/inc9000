<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDepartment extends Model
{
    protected $table = 'job_department';

    public $fillable = ['id', 'job_id', 'department_id', 'department_status', 'start_date', 'end_date'];

    protected $casts = ['start_date' => 'datetime', 'end_date' => 'datetime'];

    public function job()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }
}
