<div class="modal-dialog modal-lg">
    <form wire:submit.prevent="payment">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.pay_with_crypto') }} {{ __('bap.invoice') }} : {{ $invoice->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">

                @if($showSymbol)
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="input-group mb-2">
                              <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                       <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                              </span>
                                <input type="text" wire:model="name" class="form-control" placeholder="{{ __('bap.name') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-2">
                              <span class="input-group-text">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M6 5a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-14z"></path>
                                   <path d="M11 4h2"></path>
                                   <path d="M12 17v.01"></path>
                                </svg>
                              </span>
                                <input type="text" wire:model="phone" class="form-control" placeholder="{{ __('bap.phone') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group mb-2">
                              <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-at" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                       <path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path>
                                    </svg>
                              </span>
                                <input type="text" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('bap.email') }}" autocomplete="off">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('bap.address') }}</label>
                            <textarea class="form-control" wire:model="address" name="address" rows="6" placeholder="{{ __('bap.address') }}"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('bap.user_description') }}</label>
                            <textarea class="form-control" wire:model="user_description" name="user_description" rows="6" placeholder="{{ __('bap.user_description') }}"></textarea>
                        </div>

                    </div>
                    <div class="col-md-6">


                        <div class="mb-3">
                            <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                @foreach($symbols as $symbolItem)
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="symbol" wire:model="symbol" value="{{ $symbolItem->symbol }}" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <img width="32" height="32" src="{{ asset('cryptocurrency-icons/'.strtolower($symbolItem->symbol).'.svg') }}" />
                                                {{ $symbolItem->title }}
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">{{ __('bap.select_symbol') }}</button>
                        </div>
                    </div>
                </div>
                @else

                    @if($showNetwork)
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted text-center mb-3">{{ __('bap.please_select_network') }}</p>
                                <div class="mb-3">
                                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                        @foreach(config('symbol.'.$symbol) as $network => $networkData)
                                            <label class="form-selectgroup-item flex-fill">
                                                <input type="radio" name="network" wire:model="network" value="{{ $network }}" class="form-selectgroup-input">
                                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                    <div class="me-3">
                                                        <span class="form-selectgroup-check"></span>
                                                    </div>
                                                    <div>
                                                        <img width="32" height="32" src="{{ asset('networks/'.strtolower($network).'.svg') }}" />
                                                        {{config('networks.'.$network.'.title')  }}
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">{{ __('bap.payment') }}</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate(route('invoice.view', [$invoice->id])) !!}
                                <br />
                                {{ $networkAddress->network }}:{{ $networkAddress->symbol }}
                                <br />
                                <div class="input-group mb-2" x-data="{ total_in_symbol: '{{ $invoice->total_in_symbol }}' }">
                                    <input type="text" class="form-control" value="{{ $invoice->total_in_symbol }}" placeholder="{{ $networkAddress->address }}">
                                    <button class="btn" type="button" x-clipboard="total_in_symbol">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                                            <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="input-group mb-2" x-data="{ address: '{{ $networkAddress->address }}' }">
                                    <input type="text" class="form-control" value="{{ $networkAddress->address }}" placeholder="{{ $networkAddress->address }}">
                                    <button class="btn" type="button" x-clipboard="address">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                                            <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    @endif

                @endif

            </div>
        </div>
    </form>
</div>
