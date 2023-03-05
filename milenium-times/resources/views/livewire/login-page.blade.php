@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/auth-login-page.css') }}">
@endpush

<div class="login-page">
    <div class="hero-top-waves">
        <div class="box"></div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,256L80,229.3C160,203,320,149,480,133.3C640,117,800,139,960,133.3C1120,128,1280,96,1360,80L1440,64L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
    </div>
    <div class="main-section">
        <div class="container">
            <form wire:submit.prevent="login" class="register-card">
                @csrf

                <div class="title">Masuk</div>
                <div class="form-floating">
                    <input wire:model='email' type="email" class="form-control @error('email') is-invalid @enderror @if(Session::has('error')) is-invalid @endif" id="login_email" placeholder="email">
                    <label for="login_email">Email</label>
                    @error('email')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-floating">
                    <input wire:model='password' type="password" class="form-control @error('password') is-invalid @enderror @if(Session::has('error')) is-invalid @endif" id="login_password" placeholder="password">
                    <label for="login_password">Password</label>
                    @error('password')
                    <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                @if (Session::has('error'))
                    <small class="error">{{ Session::get('error') }}</small>
                @endif
                <button type="submit" class="login-button">
                    Masuk
                </button>
                <div class="seperator">
                    <span>Masuk dengan</span>
                </div>
                <div class="social-ic-wrapper">
                    <a href="{{ route('google-redirect') }}"><x-icon.google/></a>
                </div>
                <div class="register-suggest">
                    <span>Belum punya akun?</span>
                    <a href="{{ route('base-register') }}" class="register"> Buat Akun</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Set register-page Padding Based on Navbar Height
        function adapt_page_to_navbar_height($height) {
            $('.login-page').css('padding-top', ($height + 10) + 'px');

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
