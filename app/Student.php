<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $primaryKey = "s_id";
    protected $table = 'student';
    public $timestamps = false;
    protected $guarded = [];
}
