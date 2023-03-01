<div class="modal-dialog modal-xl">
    <form wire:submit.prevent="edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.edit_symbol') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="mb-3">
                            <label class="form-label" for="title">{{ __('bap.title') }}</label>
                            <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="{{ __('bap.title') }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-label">{{ __('bap.symbol') }}</div>
                            <input type="text" wire:model="symbol" class="form-control @error('symbol') is-invalid @enderror" name="symbol" placeholder="{{ __('bap.symbol') }}">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-label">{{ __('bap.coingeko_id') }}</div>
                            <input type="text" wire:model="coingeko_id" class="form-control @error('coingeko_id') is-invalid @enderror" name="coingeko_id" placeholder="{{ __('bap.coingeko_id') }}">
                            @error('coingeko_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="sort_order">{{ __('bap.sort_order') }}</label>
                            <input type="number" wire:model="sort_order" class="form-control @error('sort_order') is-invalid @enderror" name="sort_order" placeholder="{{ __('bap.sort_order') }}">
                            @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bap.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('bap.edit') }}</button>
            </div>
        </div>
    </form>
</div>

