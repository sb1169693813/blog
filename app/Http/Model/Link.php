<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    protected $table = 'links';
    protected $primaryKey = 'id';
    //时间
    public $timestamps = false;
    //拒绝填充
    protected $guarded = [];

}
