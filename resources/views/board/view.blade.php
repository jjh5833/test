@extends('layouts.cat')

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
                </div>

                @auth
                    @if($board->user_id == auth()->user()->id or auth()->user()->type == 1)

                        <hr>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end my-3">

                            <div>
                                <a href="{{url('/')}}/{{$board->id}}/edit" class="btn btn-outline-primary me-md-2"
                                   type="button">수정</a>
                                <form method="POST" action="{{url('/')}}/{{$board->id}}/delete">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-outline-danger" type="submit">삭제</button>
                                </form>
                            </div>
                            @endif
                            @endauth


                        </div>
                        <div class="row mt-3" align="center">
                            <div class="col-12">
                                <form method="POST" action="{{url('/')}}/heart">
                                    @csrf
                                    <input type="hidden" name="board_id" value="{{$board->id}}">
                                    추천<button type="submit" class="btn btn-outline-danger fs-3" style="padding: 1px">
                                        <i class="fas fa-heart"></i>{{App\Models\Heart::where('board_id', $board->id)->count()}}
                                    </button>
                                </form>
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
                                        {{$comment->created_at}}</small>
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
                            <button class="btn btn-outline-primary" type="submit">저장</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection
