<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller

{

    public function view() //카테고리에 보이는 카테고리 값들을 보여주는 코드
    {
        if(auth()->user()->type == 1){
        $users = User::get(); //$categories =users 는 user 카테고리에 orderby오더바이(정렬)('title','asc') 타이들에 어센딩으로 정렬을 ->get():모두 가져와라
        $categories = Category::get();
        return view('login.view')
            ->with('users', $users) //$users 값을 담은 후 login.view를 보여줄때 $users 데이터 베이스를 같이 보여줘라
            ->with('categories', $categories); //$users 값을 담은 후 login.view를 보여줄때 $users 데이터 베이스를 같이 보여줘라
        }else{
            echo "<script>
            alert('관리자가 아닙니다.');
             window.location.href=('http://localhost/test/public/');
            </script>;";

        }
    }

    public function mydata($id)
    {
        $user = User::find($id);

        return view('login.mydata')
            ->with('user', $user);


    }




    public function userdetail($id)
    {
        $user = User::find($id);
        return view('login.userdetail')
            ->with('user', $user);
    }

    public function store(Request $request) //web.php에서 Route::post('/category/store', [CategoryController::class, 'store']); 로 값이 오면 DB에 저장할 값 보내기
    {
        $category = new Category();
        $category->title = $request->title;
        $category->save();


        return redirect('/categoryc');

    }

    public function update(Request $request, $id) //web.php에서 Route::post('/category/store', [CategoryController::class, 'store']); 로 값이 오면 DB에 저장할 값 보내기
    {
        $user = User::find($id) && Hash::make($request->password);// 받아온 아이디로 카테고리를 찾으면 (id는 글 번호)
//        $user = Hash::make($request->password);
        $user->password = $request->password; //update하고
        $user->email = $request->email; //update하고
        $user->name = $request->name; //update하고
        $user->save();//저장해서

        return redirect('/'); //view로 redirect해라

    }

    public function delete($id)
    {
        $user = User::find($id); // 받아온 아이디로 카테고리를 찾으면 (id는 글 번호)
        $user->delete(); // 그 카테고리를 del 해라

        return redirect('/view'); //view로 redirect해라

    }

    public function categoryc() //카테고리에 보이는 카테고리 값들을 보여주는 코드
    {

        $categories = Category::get();
        return view('login.categoryc')
            ->with('categories', $categories); //$users 값을 담은 후 login.view를 보여줄때 $users 데이터 베이스를 같이 보여줘라

    }

    public function userdata() //카테고리에 보이는 카테고리 값들을 보여주는 코드
    {

        $users = User::get(); //$categories =users 는 user 카테고리에 orderby오더바이(정렬)('title','asc') 타이들에 어센딩으로 정렬을 ->get():모두 가져와라
        return view('login.userdata')
            ->with('users', $users); //$users 값을 담은 후 login.view를 보여줄때 $users 데이터 베이스를 같이 보여줘라

    }

}
