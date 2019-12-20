<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brande extends Model
{
    public $primaryKey = 'brand_id';

    protected $table = 'brand';

    public $timestamps = false;

    //黑名单  表设计中可以为空的字段
    protected $guarded = [];

    //白名单中 表设计中不可以为空的字段
    //protected $fillable  = ['brand_name','brand_url'];
}
