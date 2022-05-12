@extends('layouts.cat')

@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <form method="POST" action="{{url('/')}}/login/{{$user->id}}/update">
                    @method('PUT')
                    @csrf
                    {{--                    <input type="text" class="form-control" name="title" value="{{$user->type}}"> name 값이 title 이니까 수정버튼을 눌렀을때 type값이 안넘어간다. --}}
                    <input type="text" class="form-control" name="type" value="{{$user->type}}">
                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                    <input type="text" class="form-control" name="email" value="{{$user->email}}">
                {{--                    <input type="text" class="form-control" name="type" value="{{$user->name}}">--}}

            </div>
        </div>
        <div class="row my-3">

                <form method="POST" action="{{url('/')}}/login/{{$user->id}}/delete">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-outline-danger" type="submit">삭제</button>
                </form>
            </div>
        </div>
    </div>
@endsection
