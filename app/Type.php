<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $primaryKey = "type_id";
    protected $table = 'type';
    public $timestamps = false;
    protected $guarded = [];
}
