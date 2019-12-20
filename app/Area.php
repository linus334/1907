<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'area';
}