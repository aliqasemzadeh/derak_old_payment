<a class="navbar-brand navbar-brand-autodark" href="{{ route('home') }}">
    <img x-show="darkTheme" width="128" src="{{ asset('images/logo-light.svg') }}" {{ $attributes }} />
    <img x-show="!darkTheme" width="128" src="{{ asset('images/logo-dark.svg') }}" {{ $attributes }} />
</a>
