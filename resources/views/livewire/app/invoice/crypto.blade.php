<div class="modal-dialog">
    <form wire:submit.prevent="payment">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.pay_with_crypto') }} {{ __('bap.invoice') }} : {{ $invoice->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">

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
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">{{ __('bap.payment') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
