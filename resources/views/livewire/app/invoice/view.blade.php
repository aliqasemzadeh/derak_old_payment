<div>
    <x-slot name="title">
        {{ __('bap.invoice') }} : {{ $invoice->id }}
    </x-slot>

    <x-slot name="actions">
        <div class="col-auto ms-auto d-print-none">
            <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path></svg>
                {{ __('bap.print_invoice') }}
            </button>
        </div>
    </x-slot>

    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="h3">{{ $invoice->terminal->title }}</p>
                            <address>
                                {{ $invoice->terminal->merchant->address }}<br>
                                {{ $invoice->terminal->merchant->phone }}<br>
                                {{ $invoice->terminal->merchant->email }}
                            </address>
                        </div>
                        <div class="col-6 text-end">

                        </div>
                        <div class="col-12 my-5">
                            <h1>{{ __('bap.invoice') }} : {{ $invoice->id }} - {{ $invoice->created_at }}</h1>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                        <tr>
                            <th>{{ __('bap.description') }}</th>
                            <th class="text-end">{{ __('bap.total') }}</th>
                        </tr>
                        </thead>
                        <tbody><tr>
                            <td>
                                <p class="strong mb-1">{{ $invoice->description }}</p>
                            </td>
                            <td class="text-end">{{ number_format( $invoice->total ) }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold text-uppercase text-end">{{ __('bap.total_due') }}</td>
                            <td class="font-weight-bold text-end">{{ number_format( $invoice->total ) }}</td>
                        </tr>
                        </tbody></table>

                        <div class="row">
                            <div class="col-6 col-start">
                                <p class="text-muted text-center mt-5">{{ __('bap.select_type_of_payment_you_want') }}</p>

                                <p class="text-muted text-center">
                                    <button type="button" class="btn btn-primary w-100">
                                        {{ __('bap.pay_with_wallet') }}
                                    </button>
                                    <button type="button" class="btn btn-purple w-100" onclick="Livewire.emit('showModal', 'app.invoice.crypto', '{{ json_encode($invoice->id) }}')">
                                        {{ __('bap.pay_with_crypto') }}
                                    </button>
                                    <button type="button" class="btn btn-teal w-100">
                                        {{ __('bap.pay_with_fiat') }}
                                    </button>
                                </p>
                                </p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>
