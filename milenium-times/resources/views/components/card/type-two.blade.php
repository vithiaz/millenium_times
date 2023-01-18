<div class="component-card-two">
    <div class="card-content">
        <div class="card-image-container">
            <img onclick="location.href = '/post/{{ $postId }}-{{ $title_slug }}'" src="{{ $image }}" alt="{{ $title_slug }}">
        </div>
        <div class="content-neck">
            @if ($category)
            <a href="/category/{{ $category_slug }}" class="card-category">{{ $category }}</a>        
            @endif
            <span class="card-date">{{ $date }}</span>
        </div>
        <span class="card-title"><a href="/post/{{ $postId }}-{{ $title_slug }}">{{ $title }}</a></span>
    </div>
</div>