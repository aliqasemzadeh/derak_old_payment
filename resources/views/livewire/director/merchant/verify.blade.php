<div class="modal-dialog modal-lg">
    <form wire:submit.prevent="edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.edit_merchant') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="title">{{ __('bap.title') }}</label>
                            <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="{{ __('bap.title') }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label" for="website">{{ __('bap.website') }}</label>
                            <input type="text" wire:model="website" class="form-control @error('website') is-invalid @enderror" name="website" placeholder="{{ __('bap.website') }}">
                            @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-label">{{ __('bap.logo') }}</div>
                            <input type="file" wire:model="logo" class="form-control @error('logo') is-invalid @enderror" name="logo">
                            @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label" for="email">{{ __('bap.email') }}</label>
                            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('bap.email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">{{ __('bap.phone') }}</label>
                            <input type="text" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="{{ __('bap.phone') }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bap.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('bap.upload') }}</button>
            </div>
        </div>
    </form>
</div>

