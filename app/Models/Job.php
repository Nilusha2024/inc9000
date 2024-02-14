<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';

    public $fillable = [
        'id',
        'job_no',
        'client_id',
        'client_reference_no',
        'job_title',
        'material_option',
        'sleeve_details',
        'sleeve_remarks',
        'job_design_image_1',
        'job_design_image_2',
        'job_reference_document',
        'order_date',
        'deliver_date',
        'job_status',
        'invoice',
        'comment',
        'packing',
        'pattern',
        'size_label_details',
        'tshirt_details',
        'short_details',
        'logo_and_number',
        'special_note',
        'assigned_designer',
        'record_status'
    ];

    protected $casts = ['order_date' => 'datetime', 'deliver_date' => 'datetime'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }

    public function jobdetails()
    {
        return $this->hasMany('App\Models\JobDetail', 'job_id', 'id');
    }

    public function assignedDesigner()
    {
        return $this->belongsTo(User::class, 'assigned_designer', 'id');
    }
}
