@extends('layouts.cat')

@section('content')
    <div class="container mt-3">
        <form method="POST" action="{{url('/')}}/login/store">
            @csrf
            <input type="text" class="form-control" name="title">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                <button class="btn btn-outline-primary" type="submit">생성</button>
            </div>
        </form>

        <div class="row">
            <div class="col-12">
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <!-- DB에 있는 카테고리를 전부 불러오는 코드 -->
                        <li class="list-group-item">
                            <a href="{{url('/')}}/category/{{$category->id}}/view">
                                {{$category->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
