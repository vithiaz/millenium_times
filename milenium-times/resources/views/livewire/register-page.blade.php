@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/auth-register-page.css') }}">
@endpush

<div class="register-page">
    <div class="hero-top-waves">
        <div class="box"></div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,256L80,229.3C160,203,320,149,480,133.3C640,117,800,139,960,133.3C1120,128,1280,96,1360,80L1440,64L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
    </div>
    <div class="main-section">
        <div class="container">
            <div class="section-text">
                <span class="title">Buat Akun Anda,</span>
                <span class="subtitle">Satu akun untuk mengakses <strong>Milenium Sport</strong>, <strong>Milenium Environment</strong>, dan <strong>Milenium History</strong></span>
                <ul class="page-wrapper">
                    <li>
                        <a href="{{ route('sport-home') }}">
                            <div class="image-container">
                                <img src="{{ asset('image\Milenium Logo - red.png') }}" alt="">
                            </div>
                            <div class="label">
                                <span>Milenium <span class="sport">Sport</span></span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="image-container">
                                <img src="{{ asset('image\milenium-logo-green.png') }}" alt="">
                            </div>
                            <div class="label">
                                <span>Milenium <span class="env">Environment</span></span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="image-container">
                                <img src="{{ asset('image\milenium-logo-gold.png') }}" alt="">
                            </div>
                            <div class="label">
                                <span>Milenium <span class="history">History</span></span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        <form wire:submit.prevent="register" class="register-card">
            @csrf
            <span class="card-title">Daftar</span>
            <div class="form-floating">
                <input wire:model='email' class="form-control @error('email') is-invalid @enderror" type="email" id="register_email" placeholder="email">
                <label for="register_email">Email*</label>
                @error('email')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>
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
            <div class="check-box">
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
                @error('gender')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>
                <div wire:model='password' class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="register_password" placeholder="password">
                    <label for="register_password">Password*</label>
                    @error('password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-floating">
                    <input wire:model='repassword' type="password" class="form-control @error('repassword') is-invalid @enderror" id="register_repassword" placeholder="konfirmasi password">
                    <label for="register_repassword">Konfirmasi Password*</label>
                    @error('repassword')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="button-container">
                    <button type="submit" class="submit-button">Daftar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        // Set register-page Padding Based on Navbar Height
        function adapt_page_to_navbar_height($height) {
            $('.register-page').css('padding-top', ($height + 10) + 'px');

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

        
        // Page Wrapper Mouse Hover
        $('.page-wrapper li').hover(function () {
            $(this).addClass('hovered');
        }, function () {
            $(this).removeClass('hovered');
        });


    </script>
@endpush
