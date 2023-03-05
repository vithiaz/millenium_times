<div class="component-card-one swiper-slide">
    <div class="card-content">
        @if ($category)
            <a href="category/{{ $categorySlug }}" class="card-category">{{ $category }}</a>
        @endif
        <div class="card-image-container">
            @if ($image != null)
                <img onclick="location.href='post/{{ $postId }}-{{ $titleSlug }}'" src="{{ asset("storage/$image") }}" alt="{{ $titleSlug }}">            
            @else
                <img onclick="location.href='post/{{ $postId }}-{{ $titleSlug }}'" src="{{ asset('image/no-image.png') }}" alt="no-image">            
            @endif
        </div>
        <span class="card-date">{{ $date }}</span>
        <a href="post/{{ $postId }}-{{ $titleSlug }}" class="card-title">{{ $title }}</a>
    </div>
</div>