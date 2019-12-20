<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Addres extends Model
{
    public $primaryKey = 'address_id';
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'addres';
}