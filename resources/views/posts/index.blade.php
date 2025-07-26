@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách bài viết</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Thêm bài viết</a>
    </div>

    <div class="row">
        @forelse ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    {{-- Hiển thị ảnh hoặc ảnh mặc định --}}
                    @php
                        $imagePath = $post->image 
                            ? asset('storage/' . $post->image) 
                            : asset('images/default-image.jpg'); // <-- ảnh mặc định
                    @endphp
                    <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        {{-- Title link sang trang chi tiết --}}
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-primary">
                                {{ Str::limit($post->title, 50) }}
                            </a>
                        </h5>

                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>

                        <div class="mt-auto">
                            <p class="mb-1"><strong>Thể loại:</strong> {{ $post->category->name }}</p>
                            <p class="mb-1"><strong>Người viết:</strong> {{ $post->user->name }}</p>
                            <p class="mb-0 text-muted"><small>Ngày đăng: {{ $post->created_at->format('d/m/Y H:i') }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Chưa có bài viết nào.</div>
            </div>
        @endforelse
    </div>
@endsection
