<div class="{{ $this->class }}">
    <div class="slot-title">
        <span>Update</span>
    </div>
    <div class='slot-card-container @if($posts == null) grow @endif'>
        @forelse ($posts as $post)
        <div class="card-type-two">
                <div class="card-image-container">
                    <img onclick="location.href='post/{{ $post->id }}-{{ $post->title_slug }}'" src='{{ asset("storage/$post->preview_image") }}' alt="REPLACE_THIS">
                </div>
                <div class="card-content">
                    @if ($post->category)
                        <a href="category/{{ $post->category->name_slug }}" class="card-category">
                            {{ $post->category->name }}
                        </a>
                    @endif
                    <div class="card-date">
                        {{ $this->translate_date($post->created_at) }}
                    </div>
                    <a class="card-title" href="post/{{ $post->id }}-{{ $post->title_slug }}">
                        {{ $post->title }}
                    </a>
                    <div class="card-details">
                        {{ $this->get_first_paragraph($post->body) }}
                    </div>
                </div>
            </div>
        @empty    
            <div class="no-post">
                <span>Belum ada postingan pekan ini. . .</span>
            </div>
        @endforelse
    </div>
    <div class="button-wrapper">
        @if ($posts_next_count > 0)
            <button wire:click="load_more_post" class="post-more-button">Muat Lainnya</button>
        @else
            <a href="/news" class="post-redirect-button">Lihat Selengkapnya</a>
        @endif
    </div>
</div>