<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-success" href="{{ url('/') }}">
            <strong>Lelangin</strong>Store
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">

            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item my-lg-2">
                            <a class="btn btn-outline-success" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item mx-lg-3 my-2">
                            <a class="btn btn-success" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-success" href="#"
                            role="button" data-mdb-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('setting') }}">
                                    Setting
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    Profile
                                </a>
                            </li>
                            @if (Auth::user()->role == 1)
                                <li>
                                    <a class="dropdown-item" href="{{ route('adminwebsetting') }}">
                                        Web Setting
                                    </a>
                                </li>
                            @endif
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </ul>
                    </li>
                    @if (Auth::user()->role == 3)
                        <li class="nav-item mx-lg-3 my-2">
                            <a class="btn btn-sm btn-success" href="{{ route('pesertapenawaran') }}">
                                <i class="fa-solid fa-bookmark"></i>
                            </a>
                        </li>
                    @elseif (Auth::user()->role == 2)
                        <li class="nav-item mx-lg-3 my-2">
                            <a class="btn btn-sm btn-success" href="{{ route('pelelangitem') }}">
                                <i class="fa-solid fa-box"></i>
                            </a>
                        </li>
                    @elseif (Auth::user()->role == 1 || Auth::user()->role == 0)
                        <li class="nav-item mx-lg-3 my-2">
                            <a class="btn btn-sm btn-success" href="{{ route('admindashboard') }}">
                                <i class="fa-solid fa-bars"></i>
                            </a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
