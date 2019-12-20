<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $primaryKey = 'id';
    protected $table = 'article';
    public $timestamps = false;
    protected $guarded = [];
}
