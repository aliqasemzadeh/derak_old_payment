<img x-show="darkTheme" src="{{ asset('images/logo-light.svg') }}" {{ $attributes }} />
<img x-show="!darkTheme" src="{{ asset('images/logo-dark.svg') }}" {{ $attributes }} />
