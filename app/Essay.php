<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
    protected $table = 'essay';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
