<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    //
    protected $table = 'navs';
    protected $primaryKey = 'nav_id';
    //时间
    public $timestamps = false;
    //拒绝填充
    protected $guarded = [];
}
