@extends('layouts.cat')

@section('content')
    <div class="container mt-3">

        @php
            $categories = App\Models\Category::orderby('title','asc')->get();
        @endphp
        {{--        @foreach($categories as $category)--}}
        {{--        <h1 align="center" value="{{$category->id}}">{{$category->title}}</h1>--}}
        {{--        @endforeach--}}
        <h1 align="center">게시판 </h1>
        <hr>
        <div class="row my-3">
            <div class="col-12">
                <select onchange="if(this.value) location.href=(this.value);">
                    @php
                        $categories = App\Models\Category::get();
                    @endphp
                    <option value="">지역을 선택하세요.
                    @foreach($categories as $category)
                        <option value="http://localhost/test/public/{{$category->id}}/board">{{$category->title}}
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 80px">글번호</th>
                        <th scope="col">제목</th>
                        <th scope="col" style="width: 80px">작성자</th>
                        <th scope="col">작성시간</th>
                        <th scope="col" style="width: 66px">추천</th>
                        <th scope="col" style="width: 66px">조회수</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php
                        $boards = App\Models\Board::orderby('created_at', 'desc')->paginate(10);

                    @endphp
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
                                    {{--                            <a href="{{url('/')}}/{{$board->id}}/view" style="text-decoration : none" class="text-dark">{{$board->title}}</a>--}}
                                    <a href="{{url('/')}}/{{$board->id}}/view" style="text-decoration : none"
                                       class="text-dark">{{$board->title}}</a>

                                </td><!-- /제목 -->
                                {{--                        <td><!-- 글 내용 -->--}}
                                {{--                            {!!$board->content!!}--}}
                                {{--                        </td><!-- /글 내용 -->--}}
                                <td> <!-- 작성자 -->
                                    {{$user->name}}
                                </td><!-- /작성자 -->
                                <td style="width: 200px"> <!-- 쓴날짜 -->
                                    {{$board->created_at}}
                                </td> <!-- /쓴날짜 -->
                                <td><!-- 조회수 -->
                                    {{App\Models\Heart::where('board_id', $board->id)->count()}}

                                </td><!-- /조회수 -->
                                <td> <!-- 쓴날짜 -->
                                    {{$board->count}}
                                </td> <!-- /쓴날짜 -->
                        @endforeach

                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        @auth
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a href="{{url('/')}}/create" class="btn btn-outline-success" type="button">글쓰기</a>
            </div>
        @endauth

        {{ $boards->links() }}

    </div>

@endsection
