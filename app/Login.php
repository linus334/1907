<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $primaryKey = 'id';
    protected $table = 'login';
    public $timestamps = false;
    protected $guarded = [];
}
