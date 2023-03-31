<div class="modal-dialog">
    <form wire:submit.prevent="create">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.create_transaction') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label" for="type">{{ __('bap.type') }}</label>
                    <input type="text" wire:model="type" class="form-control @error('type') is-invalid @enderror" name="type" placeholder="{{ __('bap.type') }}">
                    @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="amount">{{ __('bap.amount') }}</label>
                    <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="{{ __('bap.amount') }}">
                    @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="linker_id">{{ __('bap.linker_id') }}</label>
                    <input type="text" wire:model="linker_id" class="form-control @error('linker_id') is-invalid @enderror" name="linker_id" placeholder="{{ __('bap.linker_id') }}">
                    @error('linker_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="title">{{ __('bap.note') }}</label>
                    <textarea wire:model.defer="note"
                              class="form-control @error('note') is-invalid @enderror"
                              name="note"></textarea>
                    @error('note')
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

