<div class="modal-dialog">
    <form wire:submit.prevent="create">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.create_invoice') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="total">{{ __('bap.total') }}</label>
                    <input type="text" wire:model="total" class="form-control @error('total') is-invalid @enderror" name="total" placeholder="{{ __('bap.total') }}">
                    @error('total')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">{{ __('bap.description') }}</label>
                    <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" name="total" placeholder="{{ __('bap.description') }}"></textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bap.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('bap.create') }}</button>
            </div>
        </div>
    </form>
</div>

