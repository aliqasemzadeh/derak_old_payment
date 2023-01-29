<div class="modal-dialog">
    <form wire:submit.prevent="create">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.create_invoice') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="title">{{ __('bap.title') }}</label>
                    <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="{{ __('bap.title') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="callback_url">{{ __('bap.callback_url') }}</label>
                    <input type="text" wire:model="callback_url" class="form-control @error('callback_url') is-invalid @enderror" name="callback_url" placeholder="{{ __('bap.callback_url') }}">
                    @error('callback_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">{{ __('bap.password') }}</label>
                    <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('bap.password') }}">
                    @error('password')
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

