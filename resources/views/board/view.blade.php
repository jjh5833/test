@extends('layouts.cat')
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944"></script>
<script type="text/javascript"
        src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944&libraries=services,clusterer,drawing"></script>

@section('content')

    <div class="container">
        <div class="row">

            <div>
                <div class="col-12 border border-1 mt-5">
                    <div class="row">

                        <h3>{{$board->title}}</h3>
                        <h3>조회수{{$board->count}}</h3>

                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="row">
                        {!!$board->content!!}
                    </div>
                    {{--             이미지 자리        <img src="./image/guide_map_main.jpg" id="imgname" align="left">--}}

                    {{--이미지 태그를 걸고 저장 장소에 파일이 올라가야하는데?--}}
                    {!! $board->imgname !!}
                </div>

                <div id="map" style="width:500px;height:400px;">
                    <body>
                    <div id="map" style="width:500px;height:400px;"></div>
                    <script type="text/javascript"
                            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944"></script>
                    <script>
                        var container = document.getElementById('map');
                        var options = {
                            center: new kakao.maps.LatLng(33.450701, 126.570667),
                            level: 3
                        };

                        var map = new kakao.maps.Map(container, options);

                        var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
                        var options = { //지도를 생성할 때 필요한 기본 옵션
                            center: new kakao.maps.LatLng(33.450701, 126.570667), //지도의 중심좌표.
                            level: 3 //지도의 레벨(확대, 축소 정도)
                        };

                        var map = new kakao.maps.Map(container, options);
                    </script>
                    </body>
                </div>
                @auth
                    @if($board->user_id == auth()->user()->id or auth()->user()->type == 1)

                        <hr>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end my-3">
                            <a href="{{url('/')}}/{{$board->id}}/edit" class="btn btn-outline-primary me-md-2"
                               type="button" style="height: 38px;">수정</a>
                            <form method="POST" action="{{url('/')}}/{{$board->id}}/delete">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">삭제</button>
                            </form>
                            <a href="http://localhost/test/public/free" class="btn btn-outline-secondary me-md-2"
                               type="button" style="float: right; height: 38px;">목록</a>
                            @endif
                            @endauth


                        </div>

                        <div class="row mt-3" align="center">
                            <div class="col-12">
                                <form method="POST" action="{{url('/')}}/heart" autocomplete="off" onclick="history.go(-2)">
                                    @csrf
                                    <input type="hidden" name="board_id" value="{{$board->id}}">
                                    추천
                                    <button type="submit" class="btn btn-outline-danger fs-3" style="padding: 1px">
                                        <i class="fas fa-heart"></i>{{App\Models\Heart::where('board_id', $board->id)->count()}}
                                    </button>
                                </form>
                                @guest
                                    <a href="http://localhost/test/public/free"
                                       class="btn btn-outline-secondary me-md-2"
                                       type="button" style="float: right">목록</a>
                                @endguest
                            </div>
                        </div>
            </div>
            {{--   좋아요 버튼 예정    --}}
            <div class="row my-3">
                <div class="col-12">
                    <ul class="list-group">
                        @php
                            $comments = App\Models\Comment::where('board_id', $board->id)->orderby('created_at','asc')->get(); //게시글 별 댓글 값 가져오기
                        @endphp
                        @if(count($comments)>0)
                            @foreach($comments as $comment)
                                {{-- <li class="list-group-item list-group-item-action">{{$comments->comment}} : error ->Property [comment] does not exist on this collection instance. --}}
                                {{-- <li class="list-group-item list-group-item-action">{{$comment->comment}} : comments에서 comment 값을 가져오니 안나오지 --}}
                                <li class="list-group-item list-group-item-action">{{$comment->comments}}
                                    <small class="nav justify-content-end">
                                        @php
                                            $user = App\Models\User::find($comment->user_id);
                                        @endphp
                                        작성자: {{$user->name}} |
                                        {{$comment->created_at}} | 댓글아이디 {{$comment->id}}</small>
                                <li class="list-group-item list-group-item-action">
                                    <a href="#" >댓글쓰기 누르면 드롭 다운</a> <br>
                                    대댓 작성 구역
{{--                                    <form method="POST" action="{{url('/')}}/comment1/store" target="_self" >--}}
                                    <form method="POST" action="{{url('/')}}/comment1/store" target="_self" autocomplete="off" onchange="">
                                        @csrf
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                {{--                    <input type="text" class="form-control" name="comments"> 값이 안들어갈때 확인--}}
                                                <input type="text" class="form-control" name="comment">
                                                <input type="hidden" name="board_id" value="{{$board->id}}">
                                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                <!-- board_id 값을 받아올 곳이 없으니 hidden으로 숨긴고 선언을 해줌 -->
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                                    <button class="btn btn-outline-primary" type="submit">대댓쓰기</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    @php
                                        $comment1s = App\Models\Comment1::where('comment_id', $comment->id)->orderby('created_at','asc')->get(); //게시글 별 댓글 값 가져오기
                                    @endphp
                                    @if(count($comment1s)>0)
                                       <ul class="depth_1">
                                        @foreach($comment1s as $comment)
                                            &nbsp {{$comment->comments}} <br><small class="nav justify-content-end">
                                                @php
                                                    $user = App\Models\User::find($comment->user_id);
                                                @endphp
                                                작성자:{{$user->name}} |
                                                {{$comment->created_at}} | 대댓글아이디 {{$comment->id}}</small>

                                        @endforeach
                                       </ul>
                                    @endif
                                </li>
                                </li>
                            @endforeach

                        @endif
                    </ul>
                </div>
            </div>
            <form method="POST" action="{{url('/')}}/comment/store">
                @csrf
                <div class="row mt-2">
                    <div class="col-12">
                        {{--                    <input type="text" class="form-control" name="comments"> 값이 안들어갈때 확인--}}
                        <input type="text" class="form-control" name="comment">
                        <input type="hidden" name="board_id" value="{{$board->id}}">
                        <!-- board_id 값을 받아올 곳이 없으니 hidden으로 숨긴고 선언을 해줌 -->
                    </div>
                    <div class="col-12">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                            <button class="btn btn-outline-primary" type="submit">댓글쓰기</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


@endsection
