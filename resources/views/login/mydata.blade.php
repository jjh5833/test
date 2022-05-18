@extends('layouts.cat')

@section('content')

    <div class="container mt-3">

        <ul class="list-group">
            <form method="POST" action="{{url('/')}}/login/{{$user->id}}/update">
                @method('PUT')
                @csrf


                이름 값 <input type="text" class="form-control" name="name" value="{{$user->name}}" style="width: 200px">
                패스워드 <input type="text" class="form-control" name="password" value="{{$user->password}}" style="width: 200px">
                로그인값 <input type="text" class="form-control" name="email" value="{{$user->email}}" style="width: 200px">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                    <button class="btn btn-info me-md-2" type="submit">수정</button>
                </div>
            </form>

        </ul>
    </div>
@endsection
