@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        @php
            $imagePath = $post->image 
                ? asset('storage/' . $post->image) 
                : asset('storage/images/default-image.jpg'); // <-- ảnh mặc định
        @endphp
       <img src="{{ $imagePath }}" class="card-img-top" style="height: 300px; object-fit: contain;">


        <div class="card-body">
            <h3 class="card-title">{{ $post->title }}</h3>
            <p class="text-muted">
                Thể loại: {{ $post->category->name }} |
                Người viết: {{ $post->user->name }} |
                Ngày đăng: {{ $post->created_at->format('d/m/Y H:i') }}
            </p>
            <p class="card-text">{{ $post->content }}</p>

            @canManagePost($post)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Xoá bài viết này?')">Xoá</button>
                </form>
            @endcanManagePost
        </div>
    </div>
@endsection
