<div class="modal-dialog">
    <form wire:submit.prevent="payment">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.invoice') }} : {{ $invoice->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">
                @foreach($symbols as $symbol)
                        <button href="#" class="btn btn-tabler w-100 mb-3">
                            <img width="16" height="16" src="{{ asset('cryptocurrency-icons/'.strtolower($symbol->symbol).'.svg') }}" />
                            {{ $symbol->title }}
                        </button>
                @endforeach
            </div>
        </div>
    </form>
</div>
