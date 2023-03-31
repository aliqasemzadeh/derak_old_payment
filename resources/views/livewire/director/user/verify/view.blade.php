<div class="modal-dialog  modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.verify_account') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-fluid" src="{{ route('panel.download.verify_file', [$verify->id]) }}">
                    </div>
                    <div class="col-md-12">
                        <img class="img-fluid" src="{{ route('panel.download.id_card_file', [$verify->id]) }}">
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">{{ __('bap.random_string') }}</label>
                            <input readonly type="text" wire:model="random_string" id="zipcode" class="form-control @error('random_string') is-invalid @enderror" name="random_string">
                            @error('random_string')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.first_name') }}</label>
                                            <input readonly type="text" wire:model="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name">
                                            @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.last_name') }}</label>
                                            <input readonly type="text" wire:model="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                                            @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.id_number') }}</label>
                                            <input readonly type="text" wire:model="id_number" id="id_number" class="form-control @error('id_number') is-invalid @enderror" name="id_number">
                                            @error('id_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.birth_at') }}</label>
                                            <input readonly type="text" wire:model="birth_at" id="birth_at" class="form-control @error('birth_at') is-invalid @enderror" name="birth_at">
                                            @error('birth_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.phone') }}</label>
                                            <input readonly type="text" wire:model="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone">
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.zipcode') }}</label>
                                            <input readonly type="text" wire:model="zipcode" id="zipcode" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode">
                                            @error('zipcode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.country') }}</label>
                                            <input readonly type="text" wire:model="country" id="country" class="form-control @error('country') is-invalid @enderror" name="country">
                                            @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.region') }}</label>
                                            <input readonly type="text" wire:model="region" id="region" class="form-control @error('region') is-invalid @enderror" name="region">
                                            @error('region')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.city') }}</label>
                                            <input readonly type="text" wire:model="city" id="city" class="form-control @error('city') is-invalid @enderror" name="city">
                                            @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('bap.address') }}</label>
                                            <textarea readonly wire:model="address" name="address" class="form-control @error('address') is-invalid @enderror"></textarea>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">{{ __('bap.note') }}</label>
                            <textarea wire:model="note" name="note" class="form-control @error('note') is-invalid @enderror"></textarea>
                            @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="reject">{{ __('bap.reject') }}</button>
                <button type="submit" class="btn btn-primary" wire:click="verify">{{ __('bap.verify') }}</button>
                @if($status == 'inquiry')<button type="button" class="btn btn-secondary" wire:click="inquiry">{{ __('bap.inquiry') }}</button>@endif
            </div>
        </div>
</div>
