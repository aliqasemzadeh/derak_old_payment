<div>
    <x-slot name="title">
        {{ __('bap.addresses') }}
    </x-slot>
    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.payment.address.index') }}">{{ __('bap.addresses') }}</a></li>
        </ol>
    </x-slot>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <form wire:submit.prevent="export" method="post" class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('bap.chain_address_generator') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="count">{{ __('bap.count') }}</label>
                                                <input type="number" wire:model="count" class="form-control" name="count" placeholder="{{ __('bap.count') }}">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-label" for="chain">{{ __('bap.network') }}</div>
                                                <select class="form-select" wire:model="network" id="network">
                                                    @foreach(config('networks') as $row => $network)
                                                    <option value="{{ $network }}">{{ __('network.'.$network) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">{{ __('bap.export') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
