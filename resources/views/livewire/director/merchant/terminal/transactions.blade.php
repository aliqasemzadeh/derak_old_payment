<div>
    <x-slot name="title">
        {{ $terminal->merchant->title }} - {{ __('bap.terminals') }} - {{ __('bap.transactions') }}
    </x-slot>

    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('director.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('director.merchant.index') }}">{{ __('bap.merchants') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('director.merchant.terminal.index', [$terminal->merchant->id ]) }}">{{ $terminal->merchant->title }} - {{ __('bap.terminals') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('director.merchant.terminal.index', [$terminal->merchant->id]) }}">{{ $terminal->merchant->title }} - {{ __('bap.transactions') }}</a></li>
        </ol>
    </x-slot>


</div>
