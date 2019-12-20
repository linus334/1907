<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $primaryKey = 'c_id';
    protected $table = 'cart';
    protected $guarded = [];
    public $timestamps = false;
}
