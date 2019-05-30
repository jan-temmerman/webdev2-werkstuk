<header class="header">
    <h1 class="header__logo">BACKEND</h1>

    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="header__nav__container">
        <nav class="header__nav weight">
            <a class="header__link" href="{{ route('pages.home') }}">Home</a>
            <a class="header__link" href="{{ route('pages.home') }}">Contact</a>
            <a class="header__link" href="{{ route('pages.home') }}">About</a>
            <a class="header__link" href="{{ route('pages.home') }}">Privacy policy</a>
        </nav>
        <nav class="header__nav">
            <a class="header__link" href="/">News</a>
            <a class="header__link" href="{{ route('pages.projects') }}">Tech</a>
            <a class="header__link" href="{{ route('pages.projects') }}">Music</a>
            <a class="header__link" href="{{ route('pages.projects') }}">Games</a>
            <a class="header__link" href="{{ route('pages.projects') }}">Clothes</a>
            <a class="header__link" href="{{ route('pages.projects') }}">Books</a>
            @if (!Auth::check())
            <a class="header__link" href="/login">Login</a>
            @else
                <a class="header__link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            @endif
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>
</header>