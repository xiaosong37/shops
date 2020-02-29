<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'people';
    protected $primaryKey = 'p_id';
    //表里面没有created_at 和 update_at设为false
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
