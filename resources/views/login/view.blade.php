@extends('layouts.cat')

@section('content')
    <div class="container mt-3">
        @auth
            <div class="row">
                <div class="col-12">
                    <a class="nav-link" href="{{url('/')}}/categoryc">지역</a>
                    <a class="nav-link" href="{{url('/')}}/userdata">유저</a>
                    <hr>
                </div>
                @endauth
            </div>
@endsection
