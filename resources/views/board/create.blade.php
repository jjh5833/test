@extends('layouts.cat')

@section('inside_head_tag')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
{{--    <script type="text/javascript"--}}
{{--            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944"></script>--}}
{{--    <script type="text/javascript"--}}
{{--            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944&libraries=services"></script>--}}
{{--    <script type="text/javascript" src="./js/kakao.js"></script>--}}
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944&libraries=services,clusterer,drawing"></script>

@endsection
@section('content')
    <div class="container">
        @php
            $categories = App\Models\Category::orderby('id','asc')->get();
        @endphp
        <div class="row mt-5">
            <div class="col-12">
                <label>title</label>
                <input type="text" class="form-control" id="title"> <!-- title id 값의 value -->
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <select class="form-select" id="category_id"><!-- category_id id 값의 value -->
                    <label>Category</label>
                    <option value="">지역을 선택하세요.
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <div id="editor"></div>
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
    <input type="file" name="imgFile" id="imgname" enctype="multipart/form-data"/><br>
    <div class="map_wrap">
        <div id="map"
             style="width: 100%; height: 100%; position: relative; overflow: hidden;"></div>

        <div id="menu_wrap" class="bg_white">
            <div class="option">
                <div>
                    <form onsubmit="searchPlaces(); return false;">
                        키워드 : <input type="text" value="검색어를 입력하세요" id="keyword" size="20">
                        <button type="submit">검색하기</button>
                    </form>
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
                </div>
            </div>
            <hr>
            <ul id="placesList"></ul>
            <div id="pagination"></div>
        </div>
    </div>
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
        // $(document).ready(function (){
        //
        //     $('#submit').click(function (){
        //         var content = $('textarea.editor').val();
        //         console.log(content);
        //     })
        //
        // })
        var CSRF_TOKEN = $('mata[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#submit').click(function () {

                var title = $("#title").val();
                var category_id = $("#category_id").val();
                var imgname = $("#imgname").val();
                var content = $('.ck-content').html();


                $.ajax({
                    type: "POST",
                    url: "{{url ('/')}}/store",
                    data: {
                        "_token": "{{CSRF_TOKEN()}}",
                        // _token: CSRF_TOKEN,
                        title: title,
                        category_id: category_id,
                        content: content,
                        imgname: imgname,
                    },
                    dataType: 'JSON',
                    success: function success(data) {
                        console.log(data.result);
                        window.location.href = 'http://localhost/test/public/free';
                        {{--window.location.href = '/' . {{$request->board_id}}. '/board';--}}
                    },
                    // error: function (response) {
                    //     console.log(response);
                    // }
                })

            });
        });
    </script>

@endsection


