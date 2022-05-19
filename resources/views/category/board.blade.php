@extends('layouts.cat')

@section('content')
    <div class="container mt-3">

        {{--                @foreach($categories as $category)--}}
        {{--                <h1 align="center">{{$category->title}}</h1>--}}
        {{--                @endforeach--}}


        <h1 align="center">{{$category_title}} </h1> {{-- 왜 _로 값을 받아오지..? BoardController에서 선언을 해줘서? --}}
        <hr>
        <div class="row my-3">
            <div class="col-12">
                <select onchange="if(this.value) location.href=(this.value);">
                    @php
                        $categories = App\Models\Category::get();
                    @endphp
                    <option value="">게시판을 선택하세요.
                    @foreach($categories as $category)
                        <option value="http://localhost/test/public/{{$category->id}}/board">
                        {{$category->title}}
                    @endforeach
                </select>

            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">글번호</th>
                <th scope="col">제목</th>
                {{-- <th scope="col">글 내용</th>--}}
                <th scope="col" style="width: 80px">작성자</th>
                <th scope="col">작성시간</th>
                <th scope="col" style="width: 66px">추천수</th>
                <th scope="col" style="width: 66px">조회수</th>

            </tr>
            </thead>
            <tbody> <!-- 반복 시작 예정지점 -->

            @if(count($boards)>0)

                @foreach($boards as $board)

                    <tr>
                        @php
                            $user = App\Models\User::find($board->user_id);
                        @endphp
                        <th scope="row"><!-- 글번호 -->
                            {{$board->id}}
                        </th><!-- /글번호 -->
                        <td> <!-- 제목 -->
                            <a href="{{url('/')}}/{{$board->id}}/view" style="text-decoration : none"
                               class="text-dark">{{$board->title}}</a>
                        </td><!-- /제목 -->

                        <td> <!-- 작성자 -->
                            {{$user->name}}
                        </td><!-- /작성자 -->
                        <td style="width: 200px"> <!-- 쓴날짜 -->
                            {{$board->created_at}}
                        </td> <!-- /쓴날짜 -->
                        <th scope="row"><!-- 조회수 -->
                            {{App\Models\Heart::where('board_id', $board->id)->count()}}
                        </th><!-- /조회수 -->
                        <td> <!-- 쓴날짜 -->
                            {{$board->count}}
                        </td> <!-- /쓴날짜 -->

                @endforeach
            @endif

            </tbody>
        </table>
        @auth
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a href="{{url('/')}}/create" class="btn btn-outline-success" type="button">글쓰기</a>
            </div>
        @endauth
        {{ $boards->links() }}

    </div>

@endsection
