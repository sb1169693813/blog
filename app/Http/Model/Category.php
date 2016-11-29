<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    //时间
    public $timestamps = false;
    
    //index列表
    public function index()
    {
        $categorys = $this->all();
        //return $categorys;
        return $this->getTree($categorys,'cate_id','cate_pid',0);
    }

    //获取二级分类列表
    public function getTree($data,$cate_id,$cate_pid,$pid)
    {
        //定义一个新的数组存在重组的数据
        $parr = array();
        $arr = array();
        foreach ($data as $k=>$v)
        {
            //父级的取出来
            if($v->$cate_pid == $pid)
            {
                $arr[] = $data[$k];
                foreach ($data as $m=>$n)
                {
                    if($v->$cate_id == $n->$cate_pid)
                    {
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
