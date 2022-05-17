<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">DTS Soft</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <div id="menubar"
                     style="position: sticky; border-radius: 10px;border-style: outset; padding: 10px; z-index: 21; height: 50px; display: flex; flex-direction: row; justify-content: space-around; padding-top: 10px;">

                    <div id="section">

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}/free">게시판</a>
                        </li>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}/notice">공지사항</a>
                    </li>
                </div>

                @auth
                    @if(auth()->user()->type == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}/view">관리자페이지</a>
                        </li>
            @endif
            @endauth

        </div>
        </ul>
        <ul class="nav justify-content-end">

            <form method="get" action="{{url('/')}}/mydata">
                @csrf
                <li class="nav-item">
                    <div class="nav-link">
                        Welcome!
                    </div>
            </form>

        </ul>
    </div>

</nav>
