<div class="modal-dialog">
    <div class="modal-content">
            <form wire:submit.prevent="create">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('bap.create_ticket') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="title">{{ __('bap.title') }}</label>
                        <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="{{ __('bap.title') }}">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="category_id">{{ __('bap.category') }}</label>

                        <select wire:model="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                            <option></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">{{ __('bap.body') }}</label>
                        <textarea wire:model="body" class="form-control @error('body') is-invalid @enderror" name="body"></textarea>
                        @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-label">{{ __('bap.files') }}</div>
                        <input type="file" multiple wire:model="files" class="form-control @error('files') is-invalid @enderror" name="files">
                        @error('files')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bap.close') }}</button>
                    <button type="submit" class="btn btn-primary ms-auto">{{ __('bap.create') }}</button>
                </div>
            </form>
    </div>
</div>
