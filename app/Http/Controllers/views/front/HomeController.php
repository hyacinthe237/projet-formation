<?php

namespace App\Http\Controllers\views\front;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home ()
    {
        return view('front.home.home');
    }


}
