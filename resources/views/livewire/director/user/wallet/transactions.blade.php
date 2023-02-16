<div>
    <x-slot name="title">
        {{ __('bap.transactions') }}
    </x-slot>
    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('director.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('director.financial.index') }}">{{ __('bap.financial') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('director.financial.symbol.index') }}">{{ __('bap.symbols') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('director.financial.symbol.transaction', [$symbol->symbol]) }}">{{ $symbol->symbol }}</a></li>
        </ol>
    </x-slot>


</div>
