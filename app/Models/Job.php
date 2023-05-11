<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';

    public $fillable = ['id', 'job_no', 'client_id', 'client_reference_no', 'job_title', 'material_option', 'job_design_image_1', 'job_design_image_2', 'order_date', 'deliver_date', 'job_status', 'comment', 'packing'];

    protected $casts = ['order_date' => 'datetime', 'deliver_date' => 'datetime'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }

    public function jobdetails()
    {
        return $this->hasMany('App\Models\JobDetail' , 'job_id', 'id');
    }
}
