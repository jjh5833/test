@extends('layouts.cat')

@section('content')
    <div class="container mt-3">

        <ul class="list-group">
            @foreach ($users as $user)
                <!-- DB에 있는 카테고리를 전부 불러오는 코드 -->
                <li class="list-group-item">
                    <a href="{{url('/')}}/{{$user->id}}/userdetail">
                        {{$user->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
