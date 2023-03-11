<div class="modal-dialog"
     x-data="{
		printDiv() {
			var printContents = this.$refs.print.innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
			window.reload();
		}
	}"
     x-cloak
     x-ref="print"
     class="print:text-black relative"
>
    <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.invoice') }} : {{ $invoice->id }}</h5>
                <div class="card-actions btn-actions">
                    <button type="button" class="btn-action" @click="printDiv">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                        </svg>
                    </button>
                    <a href="{{ route('invoice.view', [$invoice->id]) }}" class="btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5"></path>
                            <path d="M10 14l10 -10"></path>
                            <path d="M15 4l5 0l0 5"></path>
                        </svg>
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
                </div>

            </div>
        <div class="modal-body text-center" x-ref="print">
                <h1>{{ __('bap.invoice') }} : {{ $invoice->id }}</h1>
                <h2>{{ $invoice->created_at }}</h2>
                <h2>{{ number_format( $invoice->total) }} $</h2>
                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate(route('invoice.view', [$invoice->id])) !!}
        </div>
    </div>

</div>
