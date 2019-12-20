<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reg extends Model
{
     public $primaryKey = "id";
    protected $table = 'reg';
    public $timestamps = false;
    protected $guarded = ['pwds'];
}
