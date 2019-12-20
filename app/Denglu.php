<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denglu extends Model
{
    public $primaryKey = 'user_id';
    protected $table = 'denglu';
    public $timestamps = false;
    protected $guarded = [];
}
