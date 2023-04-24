<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    protected $table = 'job_detail';

    public $fillable = ['id', 'job_id', 'design', 'type', 'qty', 'size'];
}
