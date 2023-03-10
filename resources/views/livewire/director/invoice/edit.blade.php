<div class="modal-dialog">
    <form wire:submit.prevent="edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.edit_invoice') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="terminal">{{ __('bap.terminal') }}</label>
                    <select wire:model="terminal_id" class="form-control @error('terminal_id') is-invalid @enderror" name="terminal_id" placeholder="{{ __('bap.terminal') }}">
                        <option></option>
                        @foreach($terminals as $terminal)
                            <option value="{{ $terminal->id}}">{{ $terminal->title }}</option>
                        @endforeach
                    </select>
                    @error('terminal_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label" for="symbols">{{ __('bap.symbols') }}</label>
                    <select multiple wire:model="symbols" class="form-control @error('symbols') is-invalid @enderror" name="symbols" placeholder="{{ __('bap.symbols') }}">
                        @foreach($symbolItems as $symbol)
                            <option selected value="{{ $symbol->symbol}}">{{ $symbol->title }}</option>
                        @endforeach
                    </select>
                    @error('symbols')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="total">{{ __('bap.total') }}</label>
                    <div class="input-icon mb-3">
                        <input type="text"  wire:model="total" class="form-control @error('total') is-invalid @enderror" placeholder="{{ __('bap.total') }}">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                               <path d="M12 3v3m0 12v3"></path>
                            </svg>
                        </span>
                    </div>

                    @error('total')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">{{ __('bap.email') }}</label>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('bap.email') }}">
                    @error('email')
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
                <button type="submit" class="btn btn-primary">{{ __('bap.edit') }}</button>
            </div>
        </div>
    </form>
</div>

