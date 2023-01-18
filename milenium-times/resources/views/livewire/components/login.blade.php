<div wire:ignore.self class="modal fade" id="auth_modal" tabindex="-1">
    <div class="modal-dialog">
        <form wire:submit.prevent='login' class="modal-content">
            @csrf

            <div class="close-modal-button">
                <i class="fa-solid fa-xmark" onclick="hide_auth_modal()"></i>
            </div>

            <div class="logo-wrapper">
                <img src="{{ asset('image\milenium-logo-origin.png') }}" alt="milenium-sport-logo">
                <div class="brand">
                    <span class="brand-name">Milenium</span>
                    <span class="page">Times</span>
                </div>
            </div>

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
                <a href="#"><x-icon.fb/></a>
                <a href="#"><x-icon.google/></a>
            </div>
            <div class="register-suggest">
                <span>Belum punya akun?</span>
                <a href="{{ route('base-register') }}" class="register"> Buat Akun</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>

    function hide_auth_modal() {
        $('#auth_modal').modal('hide');
    }

</script>
@endpush