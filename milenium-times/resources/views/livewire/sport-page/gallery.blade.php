@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/sport-gallerypage.css') }}">
@endpush

<div class="gallery-page">
    <div class="container">
        <div class="page-path-section">
            <span class="base-path"><a href="/">Milenium Sport</a></span>
            <i class="fa-sharp fa-solid fa-angle-right"></i>
            <span class="active">Gallery</span>
        </div>
        <div class="content-section">
            <div class="content-head">
                <div class="section-title">
                    <span>
                        Gallery
                    </span>
                </div>
                <div class="gallery-search">
                    <input type="text" placeholder="Cari di gallery">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="content-body">
                <div id="gallery-image-list" class="card-wrapper">
                    @foreach (range(0,9) as $i)
                        <div
                            class="card"
                            onclick="set_view_image({{ $i }})"
                            data-image-url="{{ asset('image/ikhsan-leonardo-imanuel-rumbay-australia-open-2022-7_169.jpeg') }}"
                            data-title='{{ $i }} - Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam quo blanditiis eos possimus voluptatibus eaque earum nemo!'
                            data-title-slug='slug'
                            data-date='22 November 2022'
                            data-post-id='3'
                            >
                            <img src="{{ asset('image/ikhsan-leonardo-imanuel-rumbay-australia-open-2022-7_169.jpeg') }}" alt="FILL THIS">
                            <div class="title-box">
                                <span href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</span>
                            </div>
                        </div>
                        {{-- <div
                            class="card"
                            onclick="full_screen_view(this)"
                            data-image-url="{{ asset('image/andrew-reshetov-Jy4rq29KZNU-unsplash.jpg') }}"
                            data-title='Quisquam quo blanditiis eos possimus voluptatibus eaque earum nemo!'
                            data-title-slug='slug'
                            data-date='22 November 2022'
                            data-post-id='4'
                            >
                            <img src="{{ asset('image/andrew-reshetov-Jy4rq29KZNU-unsplash.jpg') }}" alt="FILL THIS">
                            <div class="title-box">
                                <span href="#">Quisquam quo blanditiis eos possimus voluptatibus eaque earum nemo!</span>
                            </div>
                        </div> --}}
                    @endforeach

                    {{-- <div class="no-item">
                        <i class="fa-solid fa-circle-question"></i>
                        <span>Hasil pencarian tidak ditemukan!</span>
                    </div> --}}
                </div>
                <div class="card-pagination">
                    --pagination--
                </div>
            </div>
        </div>
    </div>
</div>

<div class="image-view-fullscreen">
    <div class="close-view">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <div class="content">
        <div class="backdrop"></div>
        <div class="content-image">
            <div class="image-container">
                <img id="view_image">
            </div>
            <div class="view-btn left-btn" onclick="prev_view();">
                <i class="fa-sharp fa-solid fa-angle-left"></i>
            </div>
            <div class="view-btn right-btn" onclick="next_view();">
                <i class="fa-sharp fa-solid fa-angle-right"></i>
            </div>
        </div>
        <div class="desc">
            <div class="title">
                <a id="view_title" href="#"></a>
            </div>
            <div class="sub-title">
                <div id="view_date" class="date"></div>
            </div>
        </div>
    </div>
</div>
    

@push('scripts')
<script>

    // Set news-page Padding Based on Navbar Height
    function adapt_page_to_navbar_height($height) {
        $('.gallery-page').css('padding-top', ($height + 10) + 'px');
    }
    adapt_page_to_navbar_height($('.navbar').height());

    $(window).resize(function () {
        adapt_page_to_navbar_height($('.navbar').height());
    });

    $(window).scroll(function () {
        adapt_page_to_navbar_height($('.navbar').height());
    });



    // Image Full Screen View Event
    let ImageViewId = 0;

    $('.close-view').click(function () {
        $('.image-view-fullscreen').removeClass('show');
    });
    
    $('.image-view-fullscreen .backdrop').click(function () {
        $('.image-view-fullscreen').removeClass('show');
    });

    let next_view = () => {
        if ( ImageViewId == ($('#gallery-image-list').children().length - 1) ) {
            set_view_image(0);
        }
        else {
            set_view_image(ImageViewId += 1);
        }
    }

    let prev_view = () => {
        if ( ImageViewId == 0 ) {
            set_view_image($('#gallery-image-list').children().length - 1);
        }
        else {
            set_view_image(ImageViewId -= 1);
        }
    }

    let set_view_image = ($order) => {
        ImageViewId = $order;
        
        let elemView = $('#gallery-image-list').children()[ImageViewId];
        full_screen_view(elemView);
    }

    let full_screen_view = ($elem) => {
        $('.image-view-fullscreen').addClass('show');

        $('#view_image').attr("src", $elem.dataset.imageUrl);
        $('#view_image').attr("alt", $elem.dataset.titleSlug);
        
        $('#view_title').text($elem.dataset.title);
        $('#view_title').attr("href", $elem.dataset.postId);
        
        $('#view_date').text($elem.dataset.date);
    }

    // Key Pressed Event
    $( document ).keyup(function(e) {
        if ($('.image-view-fullscreen').hasClass('show')) {
            if (e.key == 'Escape') {
                $('.image-view-fullscreen').removeClass('show');
            }
            if (e.keyCode == 37) {
                prev_view();
            }
            if (e.keyCode == 39) {
                next_view();
            }
        }
    });


    </script>
@endpush