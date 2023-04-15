<div>
    <x-slot name="title">
        {{ __('bap.wallet') }}
    </x-slot>
    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('store.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('store.wallet.index') }}">{{ __('bap.wallet') }}</a></li>
        </ol>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('bap.wallet') }}</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                <tr>
                    <th wire:click="sortByColumn('symbol')">{{ __('bap.symbol') }}
                        @if ($sortColumn == 'symbol')
                            @if($sortDirection == 'asc')
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
                            @else
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-down -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 9 12 15 18 9" /></svg>

                            @endif
                        @endif
                    </th>
                    <th wire:click="sortByColumn('balance')" class="text-center">{{ __('bap.balance') }}
                        @if ($sortColumn == 'balance')
                            @if($sortDirection == 'asc')
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
                            @else
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-down -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 9 12 15 18 9" /></svg>

                            @endif
                        @endif</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($wallets as $wallet)
                    <tr>
                        <td>
                            <div class="d-flex py-1 align-items-center">
                                <span class="avatar me-2" style="background-image: url('{{ asset('cryptocurrency-icons/'.strtolower($wallet->symbol).'.svg') }}')"></span>
                                <div class="flex-fill">
                                    <div class="font-weight-medium">{{ __('website.symbols.'.$wallet->symbol) }}</div>
                                    <div class="text-muted">{{ $wallet->symbol }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">{{ $wallet->balance }}</td>
                        <td class="text-end">
                                <button onclick="Livewire.emit('showModal', 'store.wallet.withdraw', '{{ json_encode($wallet->id) }}')" class="btn btn-danger btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 10l0 10"></path>
                                        <path d="M12 10l4 4"></path>
                                        <path d="M12 10l-4 4"></path>
                                        <path d="M4 4l16 0"></path>
                                    </svg>
                                    {{ __('bap.withdraw') }}
                                </button>
                            <button onclick="Livewire.emit('showModal', 'store.wallet.deposit', '{{ json_encode($wallet->id) }}')" class="btn btn-success btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 20l16 0"></path>
                                    <path d="M12 14l0 -10"></path>
                                    <path d="M12 14l4 -4"></path>
                                    <path d="M12 14l-4 -4"></path>
                                </svg>
                                {{ __('bap.deposit') }}
                            </button>
                            <button onclick="Livewire.emit('showModal', 'store.wallet.history', '{{ json_encode($wallet->id) }}')" class="btn btn-primary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-history" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 8l0 4l2 2"></path>
                                    <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5"></path>
                                </svg>
                                {{ __('bap.history') }}
                            </button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">

        </div>
    </div>
</div>
