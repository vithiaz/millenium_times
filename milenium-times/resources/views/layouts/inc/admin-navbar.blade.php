<nav class="admin-navbar">
    <div class="container">
        <div class="welcome-container">
            <span class="msg">Selamat Datang,</span>
            <span class="username">{{ Auth::user()->first_name }}</span>
        </div>
        <ul class="nav-menu">
            <li class="sport"><a href="http://sport.mileniumtimes.devz:8000">Sport</a></li>
            <li class="env"><a href="#">Environment</a></li>
            <li class="history"><a href="#">History</a></li>
        </ul>
        <div class="logout">
            {{-- Logout Confirmation Modal in admin-sidebar.blade --}}
            <button type="button" class="logout-button" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
        </div>
    </div>
</nav>

@push('scripts')
    <script>

    var checkWidth = () => {
            if($(window).width() <= 767) {
                    $(".admin-navbar .logout").after($(".admin-navbar .nav-menu"));
                }
            else {
                $(".admin-navbar .logout").before($(".admin-navbar .nav-menu"));
            }
    }
    checkWidth();

    // Resize Event
    $(window).resize(function () {
        checkWidth();
    });

    </script>
@endpush