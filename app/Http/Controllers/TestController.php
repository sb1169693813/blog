<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    //
    /**
     * @return string
     */
    public function setSession()
    {
        session('test','3213');
    }
    public function getSession()
    {
        return  session('user_info');
    }
}
