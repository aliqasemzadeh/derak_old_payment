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

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                <img src="{{ asset('images/logo-dark.svg') }}" width="110" height="32" alt="{{ config('app.name', 'Laravel') }}">
            </a>
        </div>
        <div class="card card-md">
            <div class="card-body text-center py-4 p-sm-5">
                <h1 class="mt-5">@if(isset($title)){{ $title }}@endif</h1>
                <p class="text-muted">@if(isset($description)) {{ $description }} @endif</p>
            </div>
            <div class="hr-text hr-text-center hr-text-spaceless">{{ __('bap.invoice_information') }}</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('bap.amount') }}</label>
                    <div class="input-group input-group-flat">
                <span class="input-group-text">
                 @if(isset($email)) {{ $email }} @endif
                </span>
                        <input type="text" value="{{ $email }}"readonly class="form-control ps-1"  autocomplete="off">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('bap.amount') }}</label>
                    <div class="input-group input-group-flat">
                <span class="input-group-text">
                 @if(isset($total)) {{ $total }} @endif
                </span>
                        <input type="text" readonly class="form-control ps-1"  autocomplete="off">
                    </div>
                    <div class="form-hint">{{ __('bap.help_currency') }}</div>
                </div>

                <div>
                    <label class="form-label">{{ __('bap.payment_currency') }}</label>
                    <select class="form-select mb-0">
                        <option value=""></option>
                        <option value="USDT-TRC20">USDT - TRC20</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col-4">
                <div class="progress">
                    <div class="progress-bar" style="width: 25%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" aria-label="25% Complete">
                        <span class="visually-hidden">25% Complete</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="btn-list justify-content-end">
                    <a href="#" class="btn btn-link link-secondary">
                        Set up later
                    </a>
                    <a href="#" class="btn btn-primary">
                        Continue
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.global.foot-js')
@if(isset($js))
    {{ $js }}
@endif
</body>
</html>
