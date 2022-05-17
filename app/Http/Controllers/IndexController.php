<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;



class IndexController extends Controller
{
    public function index()
    {
        return view('cat.index');
    }

    public function notice()
    {

        return view('category.notice');
    }

    public function free()
    {
        return view('category.free');

    }


    public function view1()
    {


        return view('cat.test');

    }
}
