<div>
    <x-slot name="title">
        {{ __('bap.wallet') }}
    </x-slot>

    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('director.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('director.wallet.index') }}">{{ __('bap.wallet') }}</a></li>
        </ol>
    </x-slot>

    <div class="row row-cards">

        @foreach($wallets as $wallet)
            <div class="col-12">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto d-none d-sm-block">
                                <span class="avatar" style="background-image: url({{ asset('cryptocurrency-icons/'.strtolower($wallet['symbol']).'.svg') }})"></span>
                            </div>
                            <div class="col text-truncate">
                                <a href="" class="text-body d-block">{{ $wallet['symbol'] }}</a>
                            </div>
                            <div class="col text-center">
                                    <span class="usdt-price">
                                        {{ __('bap.balance') }}:{{ number_format($wallet['balance'], 18) }}
                                    </span>
                            </div>



                            <div class="col text-end">

                                <button  wire:click="exportTransactions('{{ $wallet['symbol'] }}')" class="btn btn-orange btn-sm">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/rotate -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                        <path d="M12 17v-6"></path>
                                        <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                                    </svg>
                                    <span class="d-none d-sm-inline-block">{{ __('bap.export') }}</span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
