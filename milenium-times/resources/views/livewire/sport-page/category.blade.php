@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/sport-categorypage.css') }}">
@endpush

<div class="category-page">
    <div class="container">
        <div class="page-path-section">
            <span class="base-path"><a href="/">Milenium Sport</a></span>
            <i class="fa-sharp fa-solid fa-angle-right"></i>
            <span class=""><a href="{{ route('sport-news') }}">Berita</a></span>
            <i class="fa-sharp fa-solid fa-angle-right"></i>
            <span class=""><a href="#">Kategori</a></span>
            <i class="fa-sharp fa-solid fa-angle-right"></i>
            <span class="active">{{ $selected_category->name }}</span>
        </div>
        <div class="content-section">
            <div class="content-head">
                <div class="secton-title">
                    <div class="sub-title">
                        Kategori
                    </div>
                    <div class="title">
                        {{ $selected_category->name }}
                    </div>
                </div>
                <div class="categories-card-wrapper">
                    <button type="button" class="card active">{{ $selected_category->name }}</button>                    
                    @foreach ($categories as $category)
                        <button wire:click="select_category({{ $category->id }})" type="button" class="card {{ $category->id == $selected_category->id ? 'active' : '' }}">{{ $category->name }}</button>                    
                    @endforeach
                    @if ($categories_next_count > 0)
                        <button wire:click="load_more_categories()" type="button" class="card more-btn">Lihat Lebih</button>
                    @endif
                </div>
            </div>
            <div class="content-body">
                <div class="card-wrapper">
                    @forelse ($posts as $post)
                        <x-card.type-two
                            image='{{ asset("storage/$post->preview_image") }}'
                            category='{{ $post->category ? $post->category->name : "" }}'
                            date='{{ $this->translate_date($post->created_at) }}'
                            title='{{ $post->title }}'
                            postId='{{ $post->id }}'
                        />
                    @empty
                        <div class="no-item">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Belum ada postingan pada kategori ini!</span>
                        </div>
                    @endforelse
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
        $('.category-page').css('padding-top', ($height + 10) + 'px');
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