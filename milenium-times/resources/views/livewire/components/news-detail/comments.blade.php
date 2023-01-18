<div class="content-comments">
    <div class="title">
        Komentar
    </div>

    {{-- Comments Section --}}
    @auth
        <div class="user-profile">
            <div class="image-container">
                <img src="{{ asset('image\ikhsan-leonardo-imanuel-rumbay-australia-open-2022-7_169.jpeg') }}" alt="">
            </div>
            <span class="username">{{ Auth::user()->first_name }}</span>
        </div>
        <form wire:submit.prevent='store_comment' class="add_comment">
            <textarea wire:model='comment' class="form-control" rows="3"></textarea>
            <button type="submit">Tambahkan Komentar</button>
        </form>
    @endauth

    <div class="comments-wrapper">
        @forelse ($comments as $comment)
            <div class="user-comment">
                <div class="user-profile">
                    <div class="image-container">
                        <img src="{{ asset('image\ikhsan-leonardo-imanuel-rumbay-australia-open-2022-7_169.jpeg') }}" alt="">
                    </div>
                    <span class="username">{{ $comment->user->first_name }}</span>
                </div>
                <div class="comment-text">
                    {{ $comment->comment }}
                </div>
            </div>
        @empty
            <div class="empty-comment">
                <span>Belum ada komentar pada postingan ini!</span>
            </div>
        @endforelse
    </div>
</div>