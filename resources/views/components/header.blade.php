<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm samazon-header-container py-0">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('img/logo.jpg')}}">
        </a>

        <form class="d-flex">
            <div class="form-group w-75">
                <input class="form-control samazon-header-search-input">
            </div>
            <div class="input-group w-25">
                <button type="submit" class="btn samazon-header-search-button"><i class="fas fa-search samazon-header-search-icon"></i></button>
            </div>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item mx-3 fw-bold">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item mx-3 fw-bold">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{ route('login') }}"><i class="far fa-heart"></i></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-shopping-cart"></i></a>
                        </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('mypage') }}">
                                <i class="fas fa-user mx-1"></i><label>マイページ</label>
                            </a>

                            <a class="dropdown-item" href="{{ route('mypage.favorite') }}">
                                <i class="far fa-heart mx-1"></i><label>お気に入り</label>
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
