<div>
    <x-slot name="title">
        {{ __('bap.invoice') }} : {{ $invoice->id }}
    </x-slot>

    <x-slot name="description">
       {{ $invoice->description }}
    </x-slot>

    <x-slot name="total">
        {{ $invoice->total }}
    </x-slot>
</div>
