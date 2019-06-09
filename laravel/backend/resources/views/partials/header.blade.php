<header class="o-header">
    <div class="o-header__navcontainer">
        <nav class="m-header__nav">
            <a class="a-header__logo" href="{{ route('pages.home') }}"><h1>BACKEND</h1></a>
            <div class="a-header__divider"></div>
            <a class="a-header__link" href="{{ route('pages.projects') }}">Projects</a>
            <div class="a-header__divider"></div>
            <a class="a-header__link" href="/">News</a>
        </nav>

        <div class="m-nav__btn">
            <label for="a-nav__check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

        <nav class="m-header__nav">
            <a class="a-header__link" href="{{ route('pages.home') }}">Home</a>
            <a class="a-header__link" href="{{ route('pages.contact') }}">Contact</a>
            <a class="a-header__link" href="{{ route('pages.about') }}">About</a>
            @if (!Auth::check())
            <a class="a-header__link --button" href="/login">Login</a>
            @else
                <a class="a-header__link --button" href="{{ route('user.profile') }}">Profile</a>
            @endif
        </nav>
    </div>
</header>