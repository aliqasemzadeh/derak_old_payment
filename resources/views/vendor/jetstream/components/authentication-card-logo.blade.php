<a class="d-flex justify-content-center mb-4" href="{{ route('home') }}">
    <img x-show="!darkTheme" width="128" src="{{ asset('images/logo-light.svg') }}" {{ $attributes }} />
    <img x-show="darkTheme" width="128" src="{{ asset('images/logo-dark.svg') }}" {{ $attributes }} />
</a>
