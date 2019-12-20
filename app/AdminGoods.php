<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGoods extends Model
{
    public $primaryKey = 'g_id';
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'admin_goods';
}
