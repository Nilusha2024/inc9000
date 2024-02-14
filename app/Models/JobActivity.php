<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobActivity extends Model
{
    protected $table = 'job_activity';

    public $fillable = [ 'job_id', 'department_id', 'employee_id'];

    public function job()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'employee_id', 'id');
    }

    public function job_department()
    {
        return $this->belongsTo('App\Models\JobDepartment', 'job_id', 'job_id');
    }
}
