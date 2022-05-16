<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BoardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('cat.index');
});

//홈
Route::get('/',[IndexController::class, 'index']);
Route::get('/notice',[IndexController::class, 'notice']);
Route::get('/free',[IndexController::class, 'free']);
Route::post('/count', [IndexController::class, 'store']);//글 조회
Route::get('/view1', [IndexController::class, 'view1']); //게시글보기


//로그인
Route::get('/{id}/userdetail', [LoginController::class, 'userdetail']);
Route::get('/view', [LoginController::class, 'view']);
Route::get('/{id}/mydata', [LoginController::class, 'mydata']);
Route::get('/categoryc', [LoginController::class, 'categoryc']);
Route::get('/userdata', [LoginController::class, 'userdata']);
Route::delete('/login/{id}/delete', [LoginController::class, 'delete']);
Route::put('/login/{id}/update', [LoginController::class, 'update']);
Route::post('/login/store', [LoginController::class, 'store']);



//게시판
Route::get('/create', [BoardController::class, 'create']);
Route::post('/store', [BoardController::class, 'store']);
Route::get('/{id}/board', [BoardController::class, 'board']);
Route::get('/{id}/category', [BoardController::class, 'category']); //게시글 카테고리별
Route::get('/{id}/view', [BoardController::class, 'view']); //게시글보기
Route::post('/comment/store', [BoardController::class, 'commentStore']); //댓글
Route::get('/{id}/edit', [BoardController::class, 'edit']); //글 수정
Route::post('/update', [BoardController::class, 'update']);//글 수정2
Route::delete('/{id}/delete', [BoardController::class, 'delete']);
Route::post('/count', [BoardController::class, 'count']);//글 조회
Route::post('/heart', [BoardController::class, 'heart']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
