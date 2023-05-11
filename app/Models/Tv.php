<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    use HasFactory;
    protected $table = 'job';
    public $fillable = ['id', 'client_id', 'client_reference', 'jobdetails_id', 'client_id', 'job_no'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client','client_id','id');
    }
    public function jobdetails()
    {
        return $this->hasMany('App\Models\JobDetail', 'id' , 'jobdetails_id');
    }
}

