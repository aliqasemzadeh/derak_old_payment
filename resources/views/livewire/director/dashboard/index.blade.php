<div>
    <x-slot name="title">
        {{ __('bap.dashboard') }}
    </x-slot>
    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
        </ol>
    </x-slot>
    <div class="row row-cards">
        <div class="col-md-4">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-green text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-cashapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M17.1 8.648a.568 .568 0 0 1 -.761 .011a5.682 5.682 0 0 0 -3.659 -1.34c-1.102 0 -2.205 .363 -2.205 1.374c0 1.023 1.182 1.364 2.546 1.875c2.386 .796 4.363 1.796 4.363 4.137c0 2.545 -1.977 4.295 -5.204 4.488l-.295 1.364a.557 .557 0 0 1 -.546 .443h-2.034l-.102 -.011a.568 .568 0 0 1 -.432 -.67l.318 -1.444a7.432 7.432 0 0 1 -3.273 -1.784v-.011a.545 .545 0 0 1 0 -.773l1.137 -1.102c.214 -.2 .547 -.2 .761 0a5.495 5.495 0 0 0 3.852 1.5c1.478 0 2.466 -.625 2.466 -1.614c0 -.989 -1 -1.25 -2.886 -1.954c-2 -.716 -3.898 -1.728 -3.898 -4.091c0 -2.75 2.284 -4.091 4.989 -4.216l.284 -1.398a.545 .545 0 0 1 .545 -.432h2.023l.114 .012a.544 .544 0 0 1 .42 .647l-.307 1.557a8.528 8.528 0 0 1 2.818 1.58l.023 .022c.216 .228 .216 .569 0 .773l-1.057 1.057z"></path>
                            </svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                0 {{ __('bap.deposit') }}
                            </div>
                            <div class="text-muted">
                                0 {{ __('bap.withdraw_pending') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-blue text-white avatar">

	                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="15" y1="5" x2="15" y2="7" /><line x1="15" y1="11" x2="15" y2="13" /><line x1="15" y1="17" x2="15" y2="19" /><path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ \App\Models\Ticket::count() }} {{ __('bap.tickets') }}
                            </div>
                            <div class="text-muted">
                                {{ \App\Models\Ticket::whereIn('status', ['new', 'customer'])->count() }} {{ __('bap.unanswered_ticket') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="6" cy="19" r="2"></circle><circle cx="17" cy="19" r="2"></circle><path d="M17 17h-11v-14h-2"></path><path d="M6 5l14 1l-1 7h-13"></path></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                78 Orders
                            </div>
                            <div class="text-muted">
                                32 shipped
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-purple text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="9" cy="7" r="4"></circle><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ \App\Models\User::count() }} {{ __('bap.users') }}
                            </div>
                            <div class="text-muted">
                                {{ \App\Models\User::whereDate('created_at', \Carbon\Carbon::today())->count() }} {{ __('bap.today_users') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-teal text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-pause" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M13 20.94a8.916 8.916 0 0 1 -7.364 -2.576a9 9 0 1 1 15.306 -5.342"></path>
                                   <path d="M12 7v5l2 2"></path>
                                   <path d="M17 17v5"></path>
                                   <path d="M21 17v5"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                0 {{ __('bap.succeeded_payment') }}
                            </div>
                            <div class="text-muted">
                                0 {{ __('bap.pending_payment') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-pink text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M13 9h6a2 2 0 0 1 2 2v6m-2 2h-10a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2"></path>
                                   <path d="M12.582 12.59a2 2 0 0 0 2.83 2.826"></path>
                                   <path d="M17 9v-2a2 2 0 0 0 -2 -2h-6m-4 0a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"></path>
                                   <path d="M3 3l18 18"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                0 {{ __('bap.cashback') }}
                            </div>
                            <div class="text-muted">
                                0 {{ __('bap.used_cashback') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('bap.top_users') }}</h3>
                        </div>
                        @for($i = 0; $i<= 5; $i++)
                        <div class="list-group list-group-flush overflow-auto" style="max-height: 35rem">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#">
                                            <span class="avatar" style="background-image: url(https://i.pravatar.cc/300?img={{ $i }})"></span>
                                        </a>
                                    </div>
                                    <div class="col text-truncate">
                                        <a href="#" class="text-body d-block">

                                            @php
                                                $faker = Faker\Factory::create();
                                            @endphp
                                            {{ $faker->name }}
                                        </a>
                                        <div class="text-muted text-truncate mt-n1">125554</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('bap.network_status') }}</h3>
                </div>
                <table class="table card-table table-vcenter">
                    <thead>
                    <tr>
                        <th>{{ __('bap.network') }}</th>
                        <th colspan="2">{{ __('bap.transactions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>BTC</td>
                        <td>1,245</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 24.9%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>BEP20</td>
                        <td>3,550</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>TRC20</td>
                        <td>1,798</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 35.96%"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>ERC20</td>
                        <td>986</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 19.72%"></div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
