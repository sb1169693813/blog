<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
require_once('resources/org/code/Code.class.php');
class LoginController extends CommonController
{
    public function  login()
    {
       return view('admin.login');
//        $pdo =  Db::connection()->Pdo();
//        dd($pdo);
    }

    public function code()
    {
        $code  = new \Code();
        return $code->make();
    }
}
