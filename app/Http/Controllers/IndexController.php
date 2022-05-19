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
        $boards = Board::where('category_id');
//        $boards = Board::where('category_id', $id)->orderby('created_at', 'asc')->paginate(5); // 보드 카테고리 아이디에서 5개 시간순으로 정렬

        return view('cat.index')
            ->with('boards', $boards);

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
