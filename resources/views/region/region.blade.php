@extends('layouts.cat')

@section('content')

    @php
        $categories = App\Models\Category::orderby('title','asc')
    ->get();
    @endphp
    <div class="container" xmlns:c="http://www.w3.org/1999/xlink">
        <div class="col-12">
            <div class="row">
                @foreach

                @endforeach
                {{--           <img src="./image/guide_map_main.jpg" class="img-fluid">--}}
            </div>
        </div>
    </div>
    <body>

    </body>
@endsection
