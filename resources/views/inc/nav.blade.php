<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">DTS Soft</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" href="{{url('/')}}/category">Category</a>--}}
                {{--                </li>--}}

                {{--                @auth--}}

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}/free">게시판</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}/notice">공지사항</a>
                </li>

                @auth
                    @if(auth()->user()->type == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}/view">관리자페이지</a>
                    </li>
                    @endif
            @endauth

            {{--            @endauth--}}


        </div>
        </ul>
        <ul class="nav justify-content-end">

            {{--            @auth--}}
            <form method="get" action="{{url('/')}}/mydata">
                @csrf
                <li class="nav-item">
                    <div class="nav-link">
                        Welcome! {{auth()->user()->name}}
                    </div>
            </form>
{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="route('logout')"--}}
{{--                       onclick="event.preventDefault(); this.closest('form').submit();">--}}
{{--                        Log Out--}}
{{--                    </a>--}}
{{--            </form>--}}
            {{--            @endauth--}}
        </ul>
    </div>

</nav>
