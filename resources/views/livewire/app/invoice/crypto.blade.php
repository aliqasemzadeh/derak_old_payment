<div class="modal-dialog modal-lg">
    <form wire:submit.prevent="payment">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.pay_with_crypto') }} {{ __('bap.invoice') }} : {{ $invoice->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">

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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-at" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                       <path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path>
                                    </svg>
                              </span>
                                <input type="text" wire:model="mobile" class="form-control" placeholder="{{ __('bap.mobile') }}" autocomplete="off">
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
                                <input type="text" wire:model="phone" class="form-control" placeholder="{{ __('bap.email') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('bap.address') }}</label>
                            <textarea class="form-control" name="address" rows="6" placeholder="{{ __('bap.address') }}"></textarea>
                        </div>

                    </div>
                    <div class="col-md-6">


                        <div class="mb-3">
                            <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                @foreach($symbols as $symbol)
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="symbol" wire:model="symbol" value="{{ $symbol->symbol }}" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <img width="32" height="32" src="{{ asset('cryptocurrency-icons/'.strtolower($symbol->symbol).'.svg') }}" />
                                                {{ $symbol->title }}
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


            </div>
        </div>
    </form>
</div>
