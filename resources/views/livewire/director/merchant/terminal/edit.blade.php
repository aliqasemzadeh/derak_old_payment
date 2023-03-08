<div class="modal-dialog modal-lg">
    <form wire:submit.prevent="create">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.create_terminal') }}: {{ $merchant->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">{{ __('bap.type') }}</label>
                            <div class="form-selectgroup">

                                <label class="form-selectgroup-item">
                                    <input type="radio" wire:model="type" name="type" value="crypto" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin-bitcoin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                               <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                               <path d="M9 8h4.09c1.055 0 1.91 .895 1.91 2s-.855 2 -1.91 2c1.055 0 1.91 .895 1.91 2s-.855 2 -1.91 2h-4.09"></path>
                                               <path d="M10 12h4"></path>
                                               <path d="M10 7v10v-9"></path>
                                               <path d="M13 7v1"></path>
                                               <path d="M13 16v1"></path>
                                            </svg>
                                      {{ __('bap.crypto') }}</span>
                                </label>
                                <label class="form-selectgroup-item">
                                    <input type="radio" wire:model="type" name="type" value="fiat" class="form-selectgroup-input" checked="">
                                    <span class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                               <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                                               <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
                                            </svg>
                                      {{ __('bap.fiat') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @if($type == 'crypto')
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="title">{{ __('bap.title') }}</label>
                                <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="{{ __('bap.title') }}">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="username">{{ __('bap.username') }}</label>
                                <input type="text" wire:model="username" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="{{ __('bap.username') }}">
                                @error('username')
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
                                <div class="form-label">{{ __('bap.callback_password') }}</div>
                                <input type="text" wire:model="callback_password" class="form-control @error('callback_password') is-invalid @enderror" name="callback_password" placeholder="{{ __('bap.callback_password') }}">
                                @error('callback_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif

                    @if($type == 'fiat')
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="title">{{ __('bap.title') }}</label>
                                <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="{{ __('bap.title') }}">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="username">{{ __('bap.username') }}</label>
                                <input type="text" wire:model="username" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="{{ __('bap.username') }}">
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    @endif

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bap.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('bap.edit') }}</button>
            </div>
        </div>
    </form>
</div>

