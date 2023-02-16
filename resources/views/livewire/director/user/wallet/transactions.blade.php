<div>
    <x-slot name="title">
        {{ __('bap.transactions') }}
    </x-slot>
    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('director.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('director.financial.index') }}">{{ __('bap.financial') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('director.financial.symbol.index') }}">{{ __('bap.symbols') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('director.financial.symbol.transactions', [$symbol->symbol]) }}">{{ $symbol->symbol }}</a></li>
        </ol>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('bap.transactions') }}</h3>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="text-muted">
                    {{ __('bap.per_page') }}:
                    <div class="mx-2 d-inline-block">
                        <div class="btn-group btn-group-sm w-100">
                            <button type="button" wire:click="setPerPage(10)" class="btn @if($perPage == 10) btn-primary @endif">10</button>
                            <button type="button" wire:click="setPerPage(15)" class="btn @if($perPage == 15) btn-primary @endif">15</button>
                            <button type="button" wire:click="setPerPage(20)" class="btn @if($perPage == 20) btn-primary @endif">20</button>
                            <button type="button" wire:click="setPerPage(25)" class="btn @if($perPage == 25) btn-primary @endif">25</button>
                        </div>
                    </div>
                </div>
                <div class="ms-auto text-muted">
                    {{ __('bap.search') }}:
                    <div class="ms-2 d-inline-block">

                        <div class="input-group input-group-sm input-group-flat">
                            <input type="text"  wire:model="search" class="form-control" autocomplete="off">
                            @if($search)
                                <span class="input-group-text">
                                <a href="#clear" wire:click="clear" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Clear search"><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </a>
                              </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                <tr>
                    <th wire:click="sortByColumn('description')">{{ __('bap.description') }}
                        @if ($sortColumn == 'description')
                            @if($sortDirection == 'asc')
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
                            @else
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-down -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 9 12 15 18 9" /></svg>

                            @endif
                        @endif
                    </th>
                    <th wire:click="sortByColumn('balance')">{{ __('bap.balance') }}
                        @if ($sortColumn == 'total')
                            @if($sortDirection == 'asc')
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
                            @else
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-down -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 9 12 15 18 9" /></svg>

                            @endif
                        @endif
                    </th>
                    <th wire:click="sortByColumn('created_at')">{{ __('bap.created_at') }}
                        @if ($sortColumn == 'created_at')
                            @if($sortDirection == 'asc')
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
                            @else
                                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-down -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 9 12 15 18 9" /></svg>

                            @endif
                        @endif
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>
                            <div class="d-flex py-1 align-items-center">
                                <div class="flex-fill">
                                    <div class="font-weight-medium">{{ $transaction->type }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ number_format($transaction->amount) }}
                        </td>
                        <td>
                            {{ $transaction->created_at }}
                        </td>
                        <td class="text-end">

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            {{ $transactions->links() }}
        </div>
    </div>

</div>
