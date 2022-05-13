<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Board;
use App\Models\Comment;
use App\Models\Heart;

$prevPage = $_SERVER['HTTP_REFERER'];

header('location:' . $prevPage);

class BoardController extends Controller
{
    public function create()
    {
        $categories = Category::orderby('title', 'desc')->get();
        return view('board.create')
            ->with('categories', $categories)
            ->with('categories', $categories);
    }

    public function view($id)
    {
        $board = Board::find($id);
        $board->count += 1;
        $board->save();

        return view('board.view')
            ->with('board', $board);
    }

    public function edit($id)
    {
        $categories = Category::orderby('title', 'asc')->get();
        $board = Board::find($id);
        if (auth()->user()->id == $board->user_id or auth()->user()->type == 1) {
            return view('board.edit')
                ->with('board', $board)
                ->with('categories', $categories);
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        $board = Board::find($request->board_id);
        $board->title = $request->title;
        $board->category_id = $request->category_id;
        $board->content = $request->input('content'); // content 만 입력했을 시 Member has protected visibility 에러 발생 // input('content')로 수정

        $board->save();

        $result = $request->all();

        $data = array(
            'result' => $result
        );

        return response()->json($data);
    }

    public function store(Request $request)
    {
        if (isset(auth()->user()->id)) {
            $board = new Board;
            $board->title = $request->title;
            $board->category_id = $request->category_id;
            $board->content = $request->input('content');
            $board->user_id = auth()->user()->id; //20220509 추가 게시글 작성시 user_id값도 가져오기
            $board->save();
        }

        $result = $request->all();

        $data = array(
            'result' => $result
        );

        return response()->json($data);
    }


    public function board($id)
    {
        $category = Category::find($id);
        $category_title = $category->title;
        $boards = Board::where('category_id', $id)->orderby('created_at', 'desc')->paginate(3);

        return view('category.board')
            ->with('boards', $boards)
            ->with('category_title', $category_title); // $id/board 이동시 카테고리 타이틀 값을 가지고 이동


    }

    public function delete($id)
    {


        $board = Board::find($id); // 받아온 아이디로 카테고리를 찾으면 (id는 글 번호)
        if (auth()->user()->id == $board->user_id or auth()->user()->type == 1) {

            $board->delete(); // 그 카테고리를 del 해라

            return redirect('/');
        }
        {
            echo "<script>
            alert('로그인 정보가 맞지 않습니다.');
             window.location.href=('http://localhost/test/public/');
            </script>;";

        }
    }

    public
    function category($id)
    {
        $category = Category::find($id);
        $category_title = $category->title;

        $boards = Board::where('category_id', $id)->orderby('created_at', 'desc')->paginate(5); //$posts는 모델 Post를 통해

        return view('dts.boards')
            ->with('boards', $boards)
            ->with('category_title', $category_title);
    }

    public
    function commentStore(Request $request)
    {

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->board_id = $request->board_id;
        $comment->comments = $request->comment;
        $comment->save();

        return redirect('/' . $request->board_id . '/view');
    }

//    public function count(Request $request)
//    {
//
//
//        $board = Board::get();
//        $board->view_cnt++;
//        $board->save();
//
//        $previous = Board::where('bbs_se_cd', $notice->bbs_se_cd)->where('bbs_sn', '<', $bbsSn)->orderBy('bbs_sn')->first();
//
//
//        return view();
//    }
    public
    function heart(Request $request)
    {

        if (isset(auth()->user()->id)) {
            $board_id = $request->board_id;
            $user_id = auth()->user()->id;

            $hearts = Heart::where('board_id', $board_id)->where('user_id', $user_id)->get(); //해당 글(board_id)에 좋아요를 눌렀는지 확인하기 위해 board_id도 불러온다
            if (count($hearts) > 0) {
                foreach ($hearts as $heart) {
                    $heart->delete();
                }
            } else {
                $heart = new Heart;
                $heart->user_id = $user_id;
                $heart->board_id = $board_id;
                $heart->save();
            }
        }


//        return redirect('/' . $request->board_id . '/view');
        return back();
    }


}
