<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Conf;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfController extends CommonController
{
    //
    //
    //GET admin/conf
    public function index()
    {
        $conf = new Conf();
        $data = $conf->orderBy('conf_order','asc')->paginate(10);
        foreach($data as $k=>$v){
            //dd($v->conf_content);
            switch($v->field_type){
                case 'input':
                    $data[$k]['_html'] = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                    //echo $v->_html;
                    break;
                case 'textarea':
                    $data[$k]['_html'] = '<textarea name="conf_content[]">'.$v->conf_content.'</textarea>';
                    //echo $v->_html;
                    break;
                case 'radio':
                    //checked
                    if($v->field_value == 0){
                        $checked0 = ' checked ';
                    }else{
                        $checked0 = '';
                    }
                    if($v->field_value == 1){
                        $checked1 = ' checked ';
                    }else{
                        $checked1 = '';
                    }
                    $str = '<input type="radio" name="conf_content[]" '.$checked0.' value="'.$v->conf_content.'">'.'关闭';
                    $str .= '<input type="radio" name="conf_content[]" '.$checked1.' value="'.$v->conf_content.'">'.'开启';
                    $data[$k]['_html'] = $str;
                    //echo $v->_html;
                    break;
            }
        }
       // dd($data->all());
        return view('admin.conf.index',compact('data'));
    }
    //GET admin/conf/create添加网站配置页面
    public function create()
    {
        return view('admin.conf.create');
    }
    //POST admin/conf   添加网站配置执行
    public function store()
    {
        //post接受过来的数据
        $input =  Input::except('_token');
        //dd($input);
        //数据验证
        $rules = [
            'conf_title'=>'required',
            'conf_order'=>'numeric',
            'field_value'=>'numeric',
        ];
        $message = [
            'conf_title.required'=>'网站配置标题不能为空！',
            'conf_order.numeric'=>'网站配置排序必须是数字！',
            'field_value.numeric'=>'类型值必须是数字！',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            //插入数据
            $result =  Conf::create($input);
            //dd($rows);
            if($result){
                return redirect('admin/conf');
            }else{
                $errors['errors'] = '网站配置添加失败，请重新添加！';
                return back()->withErrors($errors);
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    // GET  admin/conf/{conf}/edit
    public function edit($id)
    {
        //文章数据
        $data = Conf::find($id);
        return view('admin.conf.edit',compact('data'));
    }
    //PUT admin/conf/{article}      | admin.conf.update
    public function update($id)
    {
        //排除不需要的数据
        $input = Input::except('_token','_method');
        //验证提交过来的数据
        //规则
        $rules = [
            'conf_title'=>'required',
            'conf_order'=>'numeric',
            'field_value'=>'numeric',
        ];
        //对应中文
        $message = [
            'conf_title.required'=>'网站配置标题不能为空！',
            'conf_order.numeric'=>'网站配置排序必须是数字！',
            'field_value.numeric'=>'类型值必须是数字！',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            //验证通过之后，更新数据
            $conf = new Conf();
            $lin =  $conf->find($id);
            $updateData['conf_name'] = $input['conf_name'];
            $updateData['conf_title'] = $input['conf_title'];
            $updateData['field_type'] = $input['field_type'];
            $updateData['field_value'] = $input['field_value'];
            $updateData['conf_order'] = $input['conf_order'];
            $updateData['conf_tips'] = $input['conf_tips'];
            $rows = $lin->update($updateData);
            if($rows > 0){
                //更新成功
                return redirect('admin/conf');//分类首页
            }else{
                //更新失败
                $errors['error'] = '网站配置更新失败，请稍后重试！';
                return back()->withErrors($errors);
            }
        }else{
            //验证失败
            return back()->withErrors($validator);
        }
    }

    public function changeContent()
    {
        $input = Input::all();
        foreach ($input['conf_id'] as $m=>$n){
            Conf::where('conf_id',$n)->update(['conf_content'=>$input['conf_content'][$m]]);
        }
        $errors['error'] = '内容更新成功！';
        return back()->withErrors($errors);
    }
    //DELETE admin/conf/{conf}删除单个网站配置
    public function destroy($id)
    {
        $rows = Conf::where('conf_id',$id)->delete();
        if($rows > 0){
            $jsondata['code'] = 1;
            $jsondata['msg'] = '删除成功！';
        }else{
            $jsondata['code'] = -1;
            $jsondata['msg'] = '删除失败！请稍后重试！';
        }
        return $jsondata;
    }

    public function changeOrder()
    {
        //echo 'sunbin';
        $input = Input::all();
        $cate = Conf::find($input['id']);
        $cate->conf_order = $input['order'];
        $rows = $cate->update();
        if($rows > 0){
            //  更新成功
            $jsondata['msg'] = '网站配置排序更新成功！';
            $jsondata['code'] = 1;
        }else{
            $jsondata['msg'] = '网站配置排序更新失败！';
            $jsondata['code'] = -1;
        }
        return $jsondata;
    }

    public function show()
    {

    }


    //写入文件
    public function putFile()
    {

        $conf = Conf::pluck('conf_content','conf_name')->all();
        $path = base_path().'\config\webconfig.php';
        $str = '<?php return '.var_export($conf,true).';';
        file_put_contents($path, $str);
    }
}
