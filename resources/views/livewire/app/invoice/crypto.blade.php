<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.invoice') }} : {{ $invoice->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($symbols as $symbol)
                    <div class="col-md-6">
                        <button type="button" wire:click="payment({{ $symbol->symbol }})" class="btn btn-tabler w-100 mb-3">
                            <img width="32" height="32" src="{{ asset('cryptocurrency-icons/'.strtolower($symbol->symbol).'.svg') }}" />
                            {{ $symbol->title }}
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</div>
