<div class="modal-dialog">
    <form wire:submit.prevent="edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.edit_xpub') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="mb-3">
                            <label class="form-label" for="name">{{ __('bap.name') }}</label>
                            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ __('bap.name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="symbol">{{ __('bap.symbol') }}</label>
                            <select wire:model="symbol" class="form-control @error('symbol') is-invalid @enderror" name="symbol">
                                <option></option>
                                @foreach($symbols as $symbol)
                                    <option value="{{ $symbol->symbol }}">{{ $symbol->symbol }}</option>
                                @endforeach
                            </select>


                            @error('symbol')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="type">{{ __('bap.type') }}</label>
                            <div class="input-group mb-2">
                                <select wire:model="type" class="form-control @error('type') is-invalid @enderror" name="type">
                                    <option></option>
                                    <option value="xpub">xpub</option>
                                    <option value="ypub">ypub</option>
                                    <option value="zpub">zpub</option>
                                </select>
                            </div>

                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="description">xPub/yPub/zPub</label>
                            <textarea wire:model="xpub" class="form-control @error('xpub') is-invalid @enderror" name="description"></textarea>
                            @error('xpub')
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
