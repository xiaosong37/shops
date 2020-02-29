<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yonghu extends Model
{
    protected $table = 'yonghu';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
