<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'article';
    protected $primaryKey = 'art_id';
    //时间
    public $timestamps = false;
    //不可填充
    protected $guarded = [];


}
