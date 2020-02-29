<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'login';
    protected $primaryKey = 'admin_id';
    //表里面没有created_at 和 update_at设为false
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
