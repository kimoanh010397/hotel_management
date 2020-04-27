<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TotalController extends Controller
{
    public function cuisine()
    {
        return view('cuisine');
    }

    public function conferences()
    {
        return view('conferences');
    }

    public function spa()
    {
        return view('spa');
    }

    public function contact_us()
    {
        return view('contact_us');
    }
//    public function comment(){
//        if (!Auth::guard('customer')->check())
//        {
//            return view('login.login');
//        }
//    }

}
