@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/user-settings-page.css') }}">
@endpush

<div class="user-settings-page">
    <div class="hero-top-waves">
        <div class="box"></div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,256L80,229.3C160,203,320,149,480,133.3C640,117,800,139,960,133.3C1120,128,1280,96,1360,80L1440,64L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
    </div>

    <div class="main-section">
        <div class="container">
            <div class="profile-section-wrapper">
                <span class="title">Pengaturan Akun</span>
                <div class="profile-wrapper">
                    <div
                        class="image-main-container"
                        x-data="{ isUploading: false, progress: 5}"
                        x-on:livewire-upload-start="isUploading = true; progress=5"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress; progress == 100 ? isUploading=false : null;"
                        >
                        @if ($image)
                            <div class="image-container">
                                @if ($delete_state)
                                    <img src="{{ $image->temporaryUrl() }}">
                                @else
                                    <img src="{{ asset('storage/'.$image) }}" alt="{{ strval(Auth::user()->id) . '-profile' }}">
                                @endif
                                <div class="option-wrapper">
                                    <button class="remove-image-button">
                                        <i class="fa-solid fa-trash"></i>
                                        <span wire:click='empty_image()'>hapus</span>
                                    </button>
                                </div>
                            </div>                            
                        @else
                            <div class="no-image-container" :class="isUploading ? 'hide' : ''">
                                @error('image')
                                    <br><small class="error" style="width: fit-content; padding-left: 0;">{{ $message }}</small>                                
                                @else
                                    <span class="no-image-text">belum ada gambar diupload</span>
                                @enderror
                                <input type="file" wire:model='image' id="input-image" accept="image/*">
                                <button class="input-image-button" onclick="$('#input-image').click()">Pilih Gambar</button>
                            </div>
                        @endif
                        
                        {{-- Progress Bar --}}
                        <div class="progress" :class="isUploading ? 'show' : ''">
                            <div class="progress-bar" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100" x-text="progress"></div>
                        </div>
                    </div>

                    <div class="user-detail-wrapper">
                        <span class="mail">{{ Auth::user()->email }}</span>
                        <span class="id">ID {{ Auth::user()->id }}</span>
                        @if (Auth::user()->google_id)
                            <small>Terdaftar melalui akun google</small>                        
                        @endif
                        
                        <div class='button-container @if($delete_state) active @endif'>
                            <button wire:click='store_image' class="btn-confirm">Simpan Perubahan</button>
                            <button wire:click='reload' class="btn-abort">Buang Perubahan</button>
                        </div>
                    </div>


                </div>
            </div>

            <div class="details-card">
                
                <span class="card-title">Informasi Akun</span>

                <form wire:submit.prevent='update_data' class="card-form">
                    <div class="form-floating">
                        <input wire:model='first_name' type="text" class="form-control @error('first_name') is-invalid @enderror" id="register_first_name" placeholder="nama depan" pattern="^[a-zA-Z ]*$">
                        <label for="register_first_name">Nama depan*</label>
                        @error('first_name')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input wire:model='last_name' type="text" class="form-control @error('last_name') is-invalid @enderror" id="register_last_name" placeholder="nama belakang" pattern="^[a-zA-Z ]*$">
                        <label for="register_last_name">Nama belakang</label>
                        @error('last_name')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>

                    
                    <div class="gender-wrapper">
                        <div class="form-check">
                            <input wire:model='gender' value="male" class="form-check-input" type="radio" name="register_gender" id="register_gender_male" checked>
                            <label class="form-check-label" for="register_gender_male">
                                Laki - laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input wire:model='gender' value="female" class="form-check-input" type="radio" name="register_gender" id="register_gender_female">
                            <label class="form-check-label" for="register_gender_female">
                            Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit" class="submit-button">Ubah</button>
                    </div>    
                </form>

                @if (Auth::user()->google_id == null)
                    <div class="card-content-separator">
                        <span>Ubah Password</span>
                    </div>
                    <form wire:submit.prevent='update_password' class="card-form">
                        <div wire:model='password' class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="edit_password" placeholder="password">
                            <label for="edit_password">Password baru</label>
                            @error('password')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input wire:model='repassword' type="password" class="form-control @error('repassword') is-invalid @enderror" id="register_repassword" placeholder="konfirmasi password">
                            <label for="register_repassword">Konfirmasi Password baru*</label>
                            @error('repassword')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="button-container">
                            <button type="submit" class="submit-button ">Ubah Password</button>
                        </div>    
                    </form>
                @endif

            </div>

        </div>
    </div>


</div>

@push('scripts')
<script>
        // Set page-content Padding Based on Navbar Height
        function adapt_page_to_navbar_height($height) {
        $('.user-settings-page').css('padding-top', ($height + 10) + 'px');

        let boxHeight = $height + 10;
        if ($(window).width() <= 668) {
            boxHeight = $height + 120;
        }
        else if ($(window).width() <= 1200) {
            boxHeight = $height + 80;
        }
        $('.hero-top-waves .box').css('height', boxHeight + 'px');

        }

        $(document).ready(function () { 
            adapt_page_to_navbar_height($('.navbar').height());
        });

        // Resize function
        $(window).resize(function () {
            adapt_page_to_navbar_height($('.navbar').height());
        });

        // Scrolling function
        $(window).scroll(function () {
            adapt_page_to_navbar_height($('.navbar').height());
        });
    
</script>
@endpush