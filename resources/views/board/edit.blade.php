@extends('layouts.cat')

@section('inside_head_tag')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

@endsection
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <label>title</label>
                <input type="text" class="form-control" id="title" value="{{$board->title}}"> <!-- title id 값의 value -->
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <select class="form-select" id="category_id"><!-- category_id id 값의 value -->
                    <label>Category</label>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == $board->category_id ? "selected" : ""}}>{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <div id="editor">{!! $board->content !!}</div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <button class="btn btn-outline-success" type="button" id="submit">글쓰기</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="board_id" value="{{$board->id}}">

@endsection

@section('before_body_end_tag')
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>


    <script>

        var CSRF_TOKEN = $('mata[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#submit').click(function () {

                // var board_id = $("$board_id").val(); 멍청이
                var board_id = $("#board_id").val();
                var title = $("#title").val();
                var category_id = $("#category_id").val();
                var content = $('.ck-content').html();


                $.ajax({
                    type: "POST",
                    url: "{{url ('/')}}/update",
                    data: {
                        "_token": "{{CSRF_TOKEN()}}",
                        // _token: CSRF_TOKEN,
                        title: title,
                        board_id: board_id,
                        category_id: category_id,
                        content: content,
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        if (result) {
                            alert("완료");
                        }
                        window.location.href = 'http://localhost/test/public/'
                    },
                    error: function() {
                        alert("에러 발생");
                    }
                })

            });
        });
    </script>

@endsection


