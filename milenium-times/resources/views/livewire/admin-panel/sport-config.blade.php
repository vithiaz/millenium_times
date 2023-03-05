@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/admin-view-config-page.css') }}">
@endpush

<div class='admin-view-config'>
    <div class="container">
        <div class="content-card">
            <div class="content-header">
                <div class="content-title sport">
                    <span>SportPage Wallpaper</span>
                </div>
            </div>

            <div class="content-body"
                x-data="{ isUploading: false, progress: 5}"        
                x-on:livewire-upload-start="isUploading = true; progress=5"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress; progress == 100 ? isUploading=false : null;"
                >
                <div class="image-container">
                    {{-- If Image --}}
                    <input type="file" wire:model='image_update' id="input-image" accept="image/*" style="display: none">

                    @if ($image)

                        @if ($upload_status)
                            <img src="{{ $image->temporaryUrl() }}" alt="milenium-sport-bg">                        
                        @else
                            <img src="{{ asset('storage/'.$image) }}" alt="milenium-sport-bg">
                        @endif

                        <div class="option-wrapper" :class="isUploading ? 'uploading' : ''">
                            <button onclick="$('#input-image').click()" class="remove-image-button">
                                <i class="fa-solid fa-repeat"></i>
                                <span>Ubah</span>
                            </button>
                        </div>
                    @else
                        <div class="no-image" :class="isUploading ? 'uploading' : ''">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span class="message">Tidak ada wallpaper dipilih.</span>
                            <div class="button-container">
                                <button class="input-image-button sport" onclick="$('#input-image').click()">Tambahkan Gambar</button>
                            </div>
                        </div>
                    @endif

                    {{-- Progress Bar --}}
                    <div class="progress" :class="isUploading ? 'show' : ''">
                        <div class="progress-bar sport" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100" x-text="progress"></div>
                    </div>
                    
                </div>
                <div class="button-wrapper" :class="isUploading ? 'disabled' : ''">
                    <button wire:click='save_changes' type="button" class="primary-btn sport">Simpan</button>
                </div>
            </div>
        </div>


    </div>
</div>

@push('scripts')
    <script>

    </script>
@endpush