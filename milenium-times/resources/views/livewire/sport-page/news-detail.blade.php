@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/sport-news-detail-page.css') }}">
@endpush

<div class="news-detail-page">
    <div class="container">
        <div class="page-path-section">
            <span class="base-path"><a href="/">Milenium Sport</a></span>
            <i class="fa-sharp fa-solid fa-angle-right"></i>
            <span class=""><a href="#">Berita</a></span>
            <i class="fa-sharp fa-solid fa-angle-right"></i>
            <span class="active">{{ $post->title }}</span>
        </div>
        <div class="section-title">
            <span class="title">Milenium Sport</span>
            @if ($post->category)
                <span class="category">/ {{ $post->category->name }}</span>
            @endif
        </div>
        <div class="content-section">
            <div class="left-side">
                <span class="content-title">{{ $post->title }}</span>
                <div class="content-sub-title">
                    <span class="date">{{ $this->translate_date($post->created_at) }}</span>
                    <div class="info">
                        <span><i class="fa-solid fa-eye"></i>{{ $visits_count }}</span>
                        <span><i class="fa-regular fa-comment"></i>{{ $comments_count }}</span>
                    </div>
                </div>
                <div class="content-share">
                    <span>Bagikan :</span>
                    <div class="icon-wrapper">
                        <a href="#"><x-icon.fb/></a>
                        <a href="#"><x-icon.ig/></a>
                        <a href="#" class="ic"><i class="fa-solid fa-link"></i></a>
                    </div>
                </div>
                <div class="content-body">
                    @if ($post->preview_image)                        
                        <div class="img-container">
                            <img src="{{ asset('storage/'.$post->preview_image) }}" alt="FILL-THIS">
                        </div>
                    @endif
                    <div class="post-body">
                        {!! $post->body !!}
                    </div>

                </div>
                <div class="post-suggestion">
                    <div class="title">
                        <span>Berita Lainnya</span>
                    </div>
                    <div class="card-wrapper">
                        @foreach ($recomendation_posts as $post)
                            <x-card.type-two
                                image='{{ asset("storage/$post->preview_image") }}'
                                category='{{ $post->category ? $post->category->name : "" }}'
                                date='{{ $this->translate_date($post->created_at) }}'
                                title='{{ $post->title }}'
                                postId='{{ $post->id }}'
                            />
                        @endforeach
                    </div>
                </div>
                
                {{-- Content Comments --}}
                <livewire:components.news-detail.comments :postId="$target_id" />

            </div>  
            <div class="right-side">
                <div class="follow-us-container">
                    <div class="title">Ikuti Kami</div>
                    <div class="icon-list">
                        <a href="#"><x-icon.fb/></a>
                        <a href="#"><x-icon.ig/></a>
                    </div>
                </div>

                {{-- Most View --}}
                <livewire:components.home.most-view-posts :pageId="$PAGE_ID"/>

                {{-- Top Categories --}}
                <livewire:components.home.top-categories :pageId="$PAGE_ID"/>
                
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>

        // Set news-page Padding Based on Navbar Height
        function adapt_page_to_navbar_height($height) {
            $('.news-detail-page').css('padding-top', ($height + 10) + 'px');
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