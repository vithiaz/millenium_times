<nav class="navbar root-navbar">
    <div class="container">
        <div class="logo-container">
            <img src="{{ asset('image\milenium-logo-origin.png') }}" alt="">
            <span class="brand">Milenium Times</span>
        </div>
        <div class="menu-wrapper">
            <ul>
                <li class="sport"><a href="{{ route('sport-home') }}">Sport</a></li>
                <li class="env"><a href="#">Environment</a></li>
                <li class="history"><a href="#">History</a></li>
            </ul>
        </div>
        <div class="auth-container">
            @auth
                <div class="logged-in">
                    <span class="username">{{ Auth::user()->first_name }}</span>
                    <i id="auth-dropdown-button" class="fa-solid fa-angle-down"></i>
                    <div class="dropdown">
                        <ul>
                            <li>
                                <i class="fa-solid fa-door-open"></i>
                                <a href="{{ route('global-logout') }}">Keluar</a>
                            </li>
                        @if (Auth::user()->user_type == '1')
                            <li>
                                <i class="fa-solid fa-toolbox"></i>
                                <a href="{{ route('admin-news-list') }}">Admin Panel</a>
                            </li>
                        @endif
                        </ul>
                    </div>
                </div>
            @endauth
            @guest
                <span class="login"><a href="{{ route('base-login') }}">Masuk</a></span>
                <span class="register"><a href="{{ route('base-register') }}">Daftar</a></span>
            @endguest
            
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        
        var checkWidth = () => {
            if($(window).width() <= 991) {
                $(".auth-container").after($(".menu-wrapper"));
            }
            else {
                $(".auth-container").before($(".menu-wrapper"));
            }
        }
        checkWidth();

        // Resize Events
        $(window).resize(function () {
            checkWidth();
            closeAuthDropdown();
            AdaptDropdownLoc();
            scroll_up();
        });
        
        // Scrolling Events
        $(window).scroll(function () {
            $('#auth-dropdown-button').removeClass('active');
            $('.auth-container .dropdown').removeClass('active');
            closeAuthDropdown();
            AdaptDropdownLoc();
        });

        // Auth Dropdown
        let AdaptDropdownLoc = () => {
            if ($('.auth-container .logged-in').length > 0) {
                const Navbar = $('.root-navbar');
                const Dropdown = $('.auth-container .logged-in .dropdown');
                const DropdownTriggerBtn = $('#auth-dropdown-button');
                const btn_offset = DropdownTriggerBtn.offset().left;
    
                Dropdown.css('left', btn_offset - Dropdown.width() + DropdownTriggerBtn.width() + 20);
                Dropdown.css('top', Navbar.height());
            }
        }

        let closeAuthDropdown = () => {
            $('#auth-dropdown-button').removeClass('active');
            $('.auth-container .logged-in .dropdown').removeClass('active');
        }

        $('#auth-dropdown-button').click(function () {
            $(this).toggleClass('active');
            $('.auth-container .logged-in .dropdown').toggleClass('active');
            AdaptDropdownLoc();
        });

        $('.auth-container .logged-in .username').click(function () {
            $('#auth-dropdown-button').toggleClass('active');
            $('.auth-container .logged-in .dropdown').toggleClass('active');
            AdaptDropdownLoc();
        });


        function scroll_up() {
            $('.navbar').addClass('scroll-up');
            $('.navbar').removeClass('scroll-down');
        }
        
        function scroll_down() {
            $('.navbar').addClass('scroll-down');
            $('.navbar').removeClass('scroll-up');
        }

        let lastScroll = 0;
    
        $(window).scroll(function () {
            if (this.scrollY <= 0) {
                $('.navbar').removeClass('scroll-up');
            }
            if (this.scrollY > $('.navbar').height()) {
                if (this.scrollY > lastScroll && !$('.navbar').hasClass('scroll-down')) {
                    scroll_down();
                }
                if (this.scrollY <= lastScroll && $('.navbar').hasClass('scroll-down')) {
                    scroll_up();
                }
            }

            lastScroll = this.scrollY;
        });

        
    </script>
@endpush