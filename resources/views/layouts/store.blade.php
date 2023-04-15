<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('bap.direction') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(isset($title)){{ $title }} - @endif{{ config('bap.name', 'BAP') }}</title>

    @include('layouts.global.favicon')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

</head>
<body class="antialiased" x-data="{ darkTheme: $persist(false) }" :class="darkTheme ? '' : 'theme-dark'">
<div class="wrapper">
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="{{ config('bap.container-panel', 'container') }}">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-dark.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                </a>
            </h1>
            <div class="navbar-nav flex-row d-lg-none">
                @include('layouts.global.user-navbar')
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="navbar-nav pt-lg-3">

                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::is('store.dashboard.index')) active @endif">
                        <a class="nav-link" href="{{ route('panel.dashboard.index') }}" >
                                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
	                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="13" r="2" /><line x1="13.45" y1="11.55" x2="15.5" y2="9.5" /><path d="M6.4 20a9 9 0 1 1 11.2 0z" /></svg>
                                    </span>
                            <span class="nav-link-title">
                                      {{ __('bap.dashboard') }}
                                    </span>
                        </a>
                    </li>



                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::is('store.invoice.index')) active @endif">
                        <a class="nav-link" href="{{ route('store.invoice.index') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-dollar"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                    <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                    <path d="M12 17v1m0 -8v1"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('bap.invoices') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::is('store.index')) active @endif">
                        <a class="nav-link" href="{{ route('store.index') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 21l18 0"></path>
                                    <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                                    <path d="M5 21l0 -10.15"></path>
                                    <path d="M19 21l0 -10.15"></path>
                                    <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('bap.stores') }}
                            </span>
                        </a>
                    </li>


                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::is('store.wallet.index')) active @endif">
                        <a class="nav-link" href="{{ route('store.wallet.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                                    <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('bap.wallet') }}
                            </span>
                        </a>

                    </li>


                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::is('store.coin.index')) active @endif">
                        <a class="nav-link" href="{{ route('store.coin.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                                   <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                                   <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                                   <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                                   <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('bap.list_coins') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::is('store.staff.index')) active @endif">
                        <a class="nav-link" href="{{ route('store.staff.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                   <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                   <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                   <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                   <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                   <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('bap.staff') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item @if(\Illuminate\Support\Facades\Route::is('store.document.index')) active @endif">
                        <a class="nav-link" href="{{ route('store.document.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                   <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                   <path d="M9 8h6"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('bap.document') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown @if(\Illuminate\Support\Facades\Route::is('admin.support.*')) show @endif">
                        <a class="nav-link dropdown-toggle" href="#navbar-user" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="true">
                                  <span class="nav-link-icon d-md-none d-lg-inline-block">
	                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1" /><circle cx="12" cy="7.5" r=".5" fill="currentColor" /></svg>
                                  </span>
                            <span class="nav-link-title">
                                    {{ __('bap.support') }}
                                  </span>
                        </a>
                        <div class="dropdown-menu @if(\Illuminate\Support\Facades\Route::is('panel.support.*')) show @endif " data-bs-popper="none">

                            <a class="dropdown-item @if(\Illuminate\Support\Facades\Route::is('panel.support.ticket.index')) active @endif @if(\Illuminate\Support\Facades\Route::is('panel.support.ticket.view')) active @endif" href="{{ route('panel.support.ticket.index') }}">
                                {{ __('bap.tickets') }}
                            </a>

                            <a class="dropdown-item @if(\Illuminate\Support\Facades\Route::is('panel.support.ticket.create')) active @endif" href="{{ route('panel.support.ticket.create') }}">
                                {{ __('bap.create_ticket') }}
                            </a>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </aside>
    @include('layouts.global.header')
    <!-- Page Content -->
    <div class="page-wrapper">
        <main class="{{ config('bap.container', 'container-fluid') }}">
            @if(isset($pretitle))
                <div class="page-pretitle">
                    {{ $pretitle }}
                </div>
            @endif
            @if(isset($title))
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                {{ $title }}
                            </h2>
                            @if(isset($breadcrumb))
                                {{ $breadcrumb }}
                            @endif
                        </div>
                        @if(isset($actions))
                            {{ $actions }}
                        @endif
                    </div>
                </div>
            @endif
            <div class="page-body">
                {{ $slot }}
            </div>
        </main>
        @include('layouts.global.footer', ['container' => config('bap.container-panel')])
    </div>
</div>


@include('layouts.global.foot-js')
@if(isset($js))
    {{ $js }}
@endif
</body>
</html>
