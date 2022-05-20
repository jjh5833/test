@extends('layouts.cat')

@section('inside_head_tag')

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    {{--    <script type="text/javascript"--}}
    {{--            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944"></script>--}}
    {{--    <script type="text/javascript"--}}
    {{--            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944&libraries=services"></script>--}}
    {{--    <script type="text/javascript" src="./js/kakao.js"></script>--}}
    <script type="text/javascript"
            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=84cab3bd2a90fe94aaa3e3bbd9282944&libraries=services,clusterer,drawing"></script>
    <style>
        .map_wrap, .map_wrap * {
            margin: 0;
            padding: 0;
            font-family: 'Malgun Gothic', dotum, '돋움', sans-serif;
            font-size: 12px;
        }

        .map_wrap a, .map_wrap a:hover, .map_wrap a:active {
            color: #000;
            text-decoration: none;
        }

        .map_wrap {
            /*position: fixed;*/
            position: absolute;
            width: 1280px;
            height: 500px;
        }

        #menu_wrap {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            margin: 10px 0 30px 10px;
            padding: 5px;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.7);
            z-index: 1;
            font-size: 12px;
            border-radius: 10px;
        }

        .bg_white {
            background: #fff;
        }

        #menu_wrap hr {
            display: block;
            height: 1px;
            border: 0;
            border-top: 2px solid #5F5F5F;
            margin: 3px 0;
        }

        #menu_wrap .option {
            text-align: center;
        }

        #menu_wrap .option p {
            margin: 10px 0;
        }

        #menu_wrap .option button {
            margin-left: 5px;
        }

        #placesList li {
            list-style: none;
        }

        #placesList .item {
            position: relative;
            /*position: absolute;*/
            border-bottom: 1px solid #888;
            overflow: hidden;
            cursor: pointer;
            min-height: 65px;
        }

        #placesList .item span {
            display: block;
            margin-top: 4px;
        }

        #placesList .item h5, #placesList .item .info {
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        #placesList .item .info {
            padding: 10px 0 10px 55px;
        }

        #placesList .info .gray {
            color: #8a8a8a;
        }

        #placesList .info .jibun {
            padding-left: 26px;
            background: url(https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/places_jibun.png) no-repeat;
        }

        #placesList .info .tel {
            color: #009900;
        }

        #placesList .item .markerbg {
            float: left;
            position: absolute;
            width: 36px;
            height: 37px;
            margin: 10px 0 0 10px;
            background: url(https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png) no-repeat;
        }

        #placesList .item .marker_1 {
            background-position: 0 -10px;
        }

        #placesList .item .marker_2 {
            background-position: 0 -56px;
        }

        #placesList .item .marker_3 {
            background-position: 0 -102px
        }

        #placesList .item .marker_4 {
            background-position: 0 -148px;
        }

        #placesList .item .marker_5 {
            background-position: 0 -194px;
        }

        #placesList .item .marker_6 {
            background-position: 0 -240px;
        }

        #placesList .item .marker_7 {
            background-position: 0 -286px;
        }

        #placesList .item .marker_8 {
            background-position: 0 -332px;
        }

        #placesList .item .marker_9 {
            background-position: 0 -378px;
        }

        #placesList .item .marker_10 {
            background-position: 0 -423px;
        }

        #placesList .item .marker_11 {
            background-position: 0 -470px;
        }

        #placesList .item .marker_12 {
            background-position: 0 -516px;
        }

        #placesList .item .marker_13 {
            background-position: 0 -562px;
        }

        #placesList .item .marker_14 {
            background-position: 0 -608px;
        }

        #placesList .item .marker_15 {
            background-position: 0 -654px;
        }

        #pagination {
            margin: 10px auto;
            text-align: center;
        }

        #pagination a {
            display: inline-block;
            margin-right: 10px;
        }

        #pagination .on {
            font-weight: bold;
            cursor: default;
            color: #777;
        }
    </style>

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
                <div id="editor" >

                </div>
            </div>
            <div class="map_wrap" style="width:800px; height: 500px; overflow: hidden; left:10px">
                <div id="map" style="width:1000px; height: 600px; position:absolute; left:50%; top:50%" >

                </div>

                <div id="menu_wrap" class="bg_white" style="left: 50%; top:50%">
                    <div class="option">
                        <div>
                            <form onsubmit="searchPlaces(); return false;">
                                키워드 : <input type="text" value="이태원 맛집" id="keyword" size="15">
                                <button type="submit">검색하기</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <ul id="placesList"></ul>
                    <div id="pagination"></div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                        <button class="btn btn-outline-success" type="button" id="submit">글쓰기</button>
                    </div>
                </div>
            </div>
            <form name="reqform" method="post" action="/test.php" enctype="multipart/form-data" target="_blank"
                  class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">

                <input type="file" name="imgFile" id="imgname"/><br>

                <input type="submit" value="업로드"/>
            </form>
        </div>
        <script>
            // 마커를 담을 배열입니다
            var markers = [];

            var mapContainer = document.getElementById('map'), // 지도를 표시할 div
                mapOption = {
                    center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
                    level: 3 // 지도의 확대 레벨
                };

            // 지도를 생성합니다
            var map = new kakao.maps.Map(mapContainer, mapOption);

            // 장소 검색 객체를 생성합니다
            var ps = new kakao.maps.services.Places();

            // 검색 결과 목록이나 마커를 클릭했을 때 장소명을 표출할 인포윈도우를 생성합니다
            var infowindow = new kakao.maps.InfoWindow({zIndex: 1});

            // 키워드로 장소를 검색합니다
            searchPlaces();

            // 키워드 검색을 요청하는 함수입니다
            function searchPlaces() {

                var keyword = document.getElementById('keyword').value;

                if (!keyword.replace(/^\s+|\s+$/g, '')) {
                    alert('키워드를 입력해주세요!');
                    return false;
                }

                // 장소검색 객체를 통해 키워드로 장소검색을 요청합니다
                ps.keywordSearch(keyword, placesSearchCB);
            }

            // 장소검색이 완료됐을 때 호출되는 콜백함수 입니다
            function placesSearchCB(data, status, pagination) {
                if (status === kakao.maps.services.Status.OK) {

                    // 정상적으로 검색이 완료됐으면
                    // 검색 목록과 마커를 표출합니다
                    displayPlaces(data);

                    // 페이지 번호를 표출합니다
                    displayPagination(pagination);

                } else if (status === kakao.maps.services.Status.ZERO_RESULT) {

                    alert('검색 결과가 존재하지 않습니다.');
                    return;

                } else if (status === kakao.maps.services.Status.ERROR) {

                    alert('검색 결과 중 오류가 발생했습니다.');
                    return;

                }
            }

            // 검색 결과 목록과 마커를 표출하는 함수입니다
            function displayPlaces(places) {

                var listEl = document.getElementById('placesList'),
                    menuEl = document.getElementById('menu_wrap'),
                    fragment = document.createDocumentFragment(),
                    bounds = new kakao.maps.LatLngBounds(),
                    listStr = '';

                // 검색 결과 목록에 추가된 항목들을 제거합니다
                removeAllChildNods(listEl);

                // 지도에 표시되고 있는 마커를 제거합니다
                removeMarker();

                for (var i = 0; i < places.length; i++) {

                    // 마커를 생성하고 지도에 표시합니다
                    var placePosition = new kakao.maps.LatLng(places[i].y, places[i].x),
                        marker = addMarker(placePosition, i),
                        itemEl = getListItem(i, places[i]); // 검색 결과 항목 Element를 생성합니다

                    // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
                    // LatLngBounds 객체에 좌표를 추가합니다
                    bounds.extend(placePosition);

                    // 마커와 검색결과 항목에 mouseover 했을때
                    // 해당 장소에 인포윈도우에 장소명을 표시합니다
                    // mouseout 했을 때는 인포윈도우를 닫습니다
                    (function (marker, title) {
                        kakao.maps.event.addListener(marker, 'mouseover', function () {
                            displayInfowindow(marker, title);
                        });

                        kakao.maps.event.addListener(marker, 'mouseout', function () {
                            infowindow.close();
                        });

                        itemEl.onmouseover = function () {
                            displayInfowindow(marker, title);

                            // 주소-좌표 변환 객체를 생성합니다
                            var geocoder = new kakao.maps.services.Geocoder();

                            // 목록에서 선택한 위치 주소 가져오기.
                            var addr = $(this).children(".info").children("span").html();

                            // 주소로 좌표를 검색합니다
                            geocoder.addressSearch(addr, function (result, status) {

                                // 정상적으로 검색이 완료됐으면
                                if (status === kakao.maps.services.Status.OK) {

                                    var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                                    // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                                    map.setCenter(coords);
                                }
                            });
                        };

                        itemEl.onmouseout = function () {
                            infowindow.close();
                        };

                        // 해위
                        itemEl.onclick = function () {
                            var infoList = [];

                            // 선택한 장소 정보 호출.
                            var info = $(this).children(".info").children();
                            var message;

                            // 배열에 각 정보들 저장.
                            for (var i = 0; i < info.length; i++) {
                                infoList.push(info[i].textContent);
                            }

                            // form 태그 값 넘김을 위한 값 전달.
                            var message1 = '<input type="hidden" name="sangho" value="' + infoList[0] + '"></div>';
                            message1 += '<input type="hidden" name="juso" value="' + infoList[1] + '"></div>';
                            message1 += '<input type="hidden" name="tel" value="' + infoList[3] + '"></div>';

                            var resultDiv1 = document.getElementById('mapResult1');
                            resultDiv1.innerHTML = message1;


                            // 지도 밑에 선택한 지역 표시.(나중에 삭제)
                            var message2 = '<div id="name" style="color: white;">상호명 : ' + infoList[0] + '</div>';
                            message2 += '<div id="roadAddr" style="color: white;">도로명주소 : ' + infoList[1] + '</div>';
                            message2 += '<div id="address" style="color: white;">지번주소 : ' + infoList[2] + '</div>';
                            message2 += '<div id="telePhone" style="color: white;">전화번호 : ' + infoList[3] + '</div>';

                            var resultDiv2 = document.getElementById('mapResult2');
                            resultDiv2.innerHTML = message2;
                        };

                    })(marker, places[i].place_name);

                    fragment.appendChild(itemEl);
                }

                // 검색결과 항목들을 검색결과 목록 Elemnet에 추가합니다
                listEl.appendChild(fragment);
                menuEl.scrollTop = 0;

                // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
                map.setBounds(bounds);
            }

            // 검색결과 항목을 Element로 반환하는 함수입니다
            function getListItem(index, places) {

                var el = document.createElement('li'),
                    itemStr = '<span class="markerbg marker_' + (index + 1) + '"></span>' +
                        '<div class="info">' +
                        '   <h5>' + places.place_name + '</h5>';

                if (places.road_address_name) {
                    itemStr += '    <span>' + places.road_address_name + '</span>' +
                        '   <span class="jibun gray">' + places.address_name + '</span>';
                } else {
                    itemStr += '    <span>' + places.address_name + '</span>';
                }

                itemStr += '  <span class="tel">' + places.phone + '</span>' +
                    '</div>';

                el.innerHTML = itemStr;
                el.className = 'item';

                return el;
            }

            // 마커를 생성하고 지도 위에 마커를 표시하는 함수입니다
            function addMarker(position, idx, title) {
                var imageSrc = 'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png', // 마커 이미지 url, 스프라이트 이미지를 씁니다
                    imageSize = new kakao.maps.Size(36, 37),  // 마커 이미지의 크기
                    imgOptions = {
                        spriteSize: new kakao.maps.Size(36, 691), // 스프라이트 이미지의 크기
                        spriteOrigin: new kakao.maps.Point(0, (idx * 46) + 10), // 스프라이트 이미지 중 사용할 영역의 좌상단 좌표
                        offset: new kakao.maps.Point(13, 37) // 마커 좌표에 일치시킬 이미지 내에서의 좌표
                    },
                    markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imgOptions),
                    marker = new kakao.maps.Marker({
                        position: position, // 마커의 위치
                        image: markerImage
                    });

                marker.setMap(map); // 지도 위에 마커를 표출합니다
                markers.push(marker);  // 배열에 생성된 마커를 추가합니다

                return marker;
            }

            // 지도 위에 표시되고 있는 마커를 모두 제거합니다
            function removeMarker() {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
                markers = [];
            }

            // 검색결과 목록 하단에 페이지번호를 표시는 함수입니다
            function displayPagination(pagination) {
                var paginationEl = document.getElementById('pagination'),
                    fragment = document.createDocumentFragment(),
                    i;

                // 기존에 추가된 페이지번호를 삭제합니다
                while (paginationEl.hasChildNodes()) {
                    paginationEl.removeChild(paginationEl.lastChild);
                }

                for (i = 1; i <= pagination.last; i++) {
                    var el = document.createElement('a');
                    el.href = "#";
                    el.innerHTML = i;

                    if (i === pagination.current) {
                        el.className = 'on';
                    } else {
                        el.onclick = (function (i) {
                            return function () {
                                pagination.gotoPage(i);
                            }
                        })(i);
                    }

                    fragment.appendChild(el);
                }
                paginationEl.appendChild(fragment);
            }

            // 검색결과 목록 또는 마커를 클릭했을 때 호출되는 함수입니다
            // 인포윈도우에 장소명을 표시합니다
            function displayInfowindow(marker, title) {
                var content = '<div style="padding:5px;z-index:1;">' + title + '</div>';

                infowindow.setContent(content);
                infowindow.open(map, marker);
            }

            // 검색결과 목록의 자식 Element를 제거하는 함수입니다
            function removeAllChildNods(el) {
                while (el.hasChildNodes()) {
                    el.removeChild(el.lastChild);
                }
            }
        </script>
        {{--    <input type="file" name="imgFile" id="imgname" value="123" enctype="text/plain">--}}
        {{--           onchange="this.select(); document.getElementById('file_path').value=document.selection.createRange().text.toString();">--}}
        {{--    <input type="text" name="file_path" id="file_path"size="100">--}}

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
                //         var imgname = $('imgname').val();
                //         console.log(imgname);
                //
                //
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

                        // $imgname = pathinfo($imgname, PATHINFO_FILENAME);

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
                                {{--window.location.href = '/{{category_id}}/board';--}}
                            },
                            // error: function (response) {
                            //     console.log(response);
                            // }
                        })

                    });
                });
            </script>

@endsection


