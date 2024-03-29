@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/sport-newspage.css') }}">
@endpush

<div class="news-page">
    <div class="container">
        <div class="page-path-section">
            <span class="base-path"><a href="/">Milenium Sport</a></span>
            <i class="fa-sharp fa-solid fa-angle-right"></i>
            <span class=""><a href="#">Berita</a></span>
        </div>
        <div class="content-section">
            <div class="section-title">
                <span>Berita</span>
            </div>
            <div class="content-head">
                <div class="hero-post">
                    <div class="image-container">
                        <img onclick="location.href = 'post/{{ $hero_post->id }}-{{ $hero_post->title_slug }}'" src='{{ asset("storage/$hero_post->preview_image") }}' alt="{{ $hero_post->title_slug }}">
                    </div>
                    <div class="details">
                        @if ($hero_post->category)
                            <div class="category">{{ $hero_post->category->name }}</div>
                        @endif
                        <div class="title"><a href="post/{{ $hero_post->id }}-{{ $hero_post->title_slug }}">{{ $hero_post->title }}</a></div>
                        <div class="date">{{ $this->translate_date($hero_post->date) }}</div>
                        <div class="details-text">{{ $this->get_first_paragraph($hero_post->body) }}</div>
                    </div>
                </div>
                <div class="categories">
                    <div class="title">Kategori Populer</div>
                    <div class="wrapper">
                        @foreach ($top_categories as $category)
                            <a href="category/{{ $category->name_slug }}" class="card">{{ $category->name }}</a>
                        @endforeach
                        <a href="/category" class="card active">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="card-wrapper">
                    @foreach ($posts as $post)
                        <x-card.type-two
                            image='{{ asset("storage/$post->preview_image") }}'
                            category='{{ $post->category ? $post->category->name : "" }}'
                            date='{{ $this->translate_date($post->created_at) }}'
                            title='{{ $post->title }}'
                            postId='{{ $post->id }}'
                        />
                    @endforeach

                    {{-- <div class="no-item">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Belum ada postingan pada kategori ini!</span>
                    </div> --}}
                    
                </div>

                <div class="card-pagination">
                    {{ $posts->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>

        // Set news-page Padding Based on Navbar Height
        function adapt_page_to_navbar_height($height) {
            $('.news-page').css('padding-top', ($height + 10) + 'px');
        }
        adapt_page_to_navbar_height($('.navbar').height());

        $(window).resize(function () {
            adapt_page_to_navbar_height($('.navbar').height());
        });

        $(window).scroll(function () {
            adapt_page_to_navbar_height($('.navbar').height());
        });

    </script>
@endpush
