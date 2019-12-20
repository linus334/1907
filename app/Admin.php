<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $primaryKey = 'admin_id';
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'admin';
}
