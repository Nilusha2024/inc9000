<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    public $fillable = ['first_name', 'last_name', 'email', 'phone_1', 'phone_2', 'address', 'status'];
}
