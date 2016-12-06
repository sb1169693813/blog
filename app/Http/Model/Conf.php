<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'conf_id';
    //时间
    public $timestamps = false;
    //拒绝填充
    protected $guarded = [];
}
