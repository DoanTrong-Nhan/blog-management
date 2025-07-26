@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách bài viết</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Thêm bài viết</a>
    </div>

    {{-- Form tìm kiếm --}}
    <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tìm theo tiêu đề...">
            <button class="btn btn-outline-secondary" type="submit">Tìm</button>
        </div>
    </form>
        <p class="text-muted">Tìm thấy {{ $posts->total() }} bài viết</p>

    {{-- Danh sách bài viết --}}
    <div class="row">
        @forelse ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @php
                        $imagePath = $post->image 
                            ? asset('storage/' . $post->image) 
                            : asset('storage/images/default-image.jpg');
                    @endphp
                    <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-primary">
                                {{ Str::limit($post->title, 50) }}
                            </a>
                        </h5>

                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>

                        <div class="mt-auto">
                            <p class="mb-1"><strong>Thể loại:</strong> {{ $post->category->name }}</p>
                            <p class="mb-1"><strong>Người viết:</strong> {{ $post->user->name }}</p>
                            <p class="mb-0 text-muted">
                                <small>Ngày đăng: {{ $post->created_at->format('d/m/Y H:i') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Không tìm thấy bài viết nào.</div>
            </div>
        @endforelse
    </div>

    {{-- Phân trang --}}
    @if ($posts->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $posts->withQueryString()->links() }}
        </div>
    @endif
@endsection
