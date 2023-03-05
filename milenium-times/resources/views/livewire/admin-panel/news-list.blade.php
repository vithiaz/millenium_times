@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/admin-news-list-page.css') }}">
@endpush

<div class="news-list-page">
    <div class="container">
        <div class="content-card">
            <div class="content-header">
                <div class="content-title">
                    <span>Daftar Berita</span>
                </div>
                <select wire:model="select_page" class="form-select">
                    @foreach ($pages as $page)
                        <option value="{{ $page->id }}"> {{ $page->name }}</option>
                    @endforeach
                </select>
                <div class="content-search">
                    <input type="text" placeholder="Cari berita">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="content-body table-responsive-md">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Tanggal</td>
                            <td>Judul</td>
                            <td>Kategori</td>
                            <td>Oleh</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->created_at->toDateString() }}</td>
                                <td>{!! $post->title !!}</td>
                                <td>{{ $post->category != null? $post->category->name : '' }}</td>
                                <td>{{ $post->user->first_name }}</td>  
                                <td>
                                    <a href="/post/edit/{{ $post->id }}-{{ $post->title_slug }}" class="edit-post-button">Edit</a>
                                </td>    
                            </tr>
                        @empty
                            <tr>
                                <td class="empty" colspan="5">Belum ada postingan . . .</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

    </script>
@endpush