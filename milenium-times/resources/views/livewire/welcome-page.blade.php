@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/welcome_app.css') }}">
@endpush


<div class="welcome-page">

    <section class="page-section-wrapper swiper">
        <div class="swiper-wrapper">

            @foreach ($pages as $page)
                <div class="page-item swiper-slide"
                    @if ($page->wallpaper_img)
                        style="background-image: url('{{ asset('storage/'.$page->wallpaper_img) }}')"
                    @endif
                >
                    <div class="container">
                        <div class="body">
                            <div class="content">
                                <div class="page-title-container">
                                    <span>{{ $page->name }}</span>
                                </div>
                                <div class="button-container">
                                    <button
                                    
                                    @if ($page->id == 1)
                                            class="btn redirect-btn red-bg"
                                            onclick="location.href='{{ route('sport-home') }}'"
                                    @endif
                                    @if ($page->id == 2)
                                        class="btn redirect-btn green-bg"
                                        onclick="location.href='{{ route('env-home') }}'"
                                    @endif
                                    @if ($page->id == 3)
                                        class="btn redirect-btn yellow-bg"
                                        onclick="location.href='{{ route('history-home') }}'"
                                    @endif

                                    >
                                        Lihat Halaman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            @endforeach
        </div>

        <div class="pagination-wrapper">
            <div class="container pagination-container">
            </div>
        </div>    
    </section>

    <section class="page-information-wrapper">
        <div class="container">
            <div class="hero-title-container">
                <span>Milenium Times</span>
            </div>
            <div class="body-main-wrapper">
                <ul class="page-wrapper">
                    <li class="hovered">
                        <a href="{{ route('sport-home') }}">
                            <div class="image-container">
                                <img src="{{ asset('image\Milenium Logo - red.png') }}" alt="milenium-sport-logo">
                            </div>
                            <div class="label">
                                <span>Milenium <span class="sport">Sport</span></span>
                            </div>
                        </a>
                    </li>
                    <li class="hovered">
                        <a href="#">
                            <div class="image-container">
                                <img src="{{ asset('image\milenium-logo-green.png') }}" alt="milenium-environment-logo">
                            </div>
                            <div class="label">
                                <span>Milenium <span class="env">Environment</span></span>
                            </div>
                        </a>
                    </li>
                    <li class="hovered">
                        <a href="#">
                            <div class="image-container">
                                <img src="{{ asset('image\milenium-logo-gold.png') }}" alt="milenium-history-logo">
                            </div>
                            <div class="label">
                                <span>Milenium <span class="history">History</span></span>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="about-text-container">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda porro similique reprehenderit quia eaque cum eos earum est, cupiditate fugiat corporis adipisci sed odit deleniti?</p>
                </div>
            </div>
            <div class="social-media-wrapper">
                <a href="#" target="_blank"><x-icon.fb/></a>
                <a href="#" target="_blank"><x-icon.ig/></a>
            </div>
        </div>
    </section>

</div>

@push('scripts')
<script>

    // Set welcome-page Padding Based on Navbar Height
    // function adapt_page_to_navbar_height($height) {
    //     $('.welcome-page .page-section-wrapper .container').css('margin-top', ($height + 10) + 'px');
    // }

    // $(document).ready(function() {
    //     adapt_page_to_navbar_height($('.navbar').height())
    // });

    // $(window).resize(function () {
    //     adapt_page_to_navbar_height($('.navbar').height());
    // });

    // $(window).scroll(function () {
    //     adapt_page_to_navbar_height($('.navbar').height());
    // });

    
    // Swiper
    var swiper1 = new Swiper(".swiper", {
    slidesPerView: 1,
    spaceBetween: 0,
    slidesPerGroup: 1,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 5000,
    },
    pagination: {
        el: ".pagination-container",
        clickable: true,
    }
    // navigation: {
    //     nextEl: ".swipe-next-btn",
    //     prevEl: ".swipe-prev-btn",
    // },
    });


    // Turn Navigation to Dark    
    $(document).ready(function () {
        $('.root-navbar').addClass('dark')
    });


</script>
@endpush