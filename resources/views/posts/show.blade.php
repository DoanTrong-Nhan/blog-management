@extends('layouts.app')

@section('content')
    <h2>{{ $post->title }}</h2>

    <p><strong>Thể loại:</strong> {{ $post->category->name }}</p>
    <p><strong>Tác giả:</strong> {{ $post->user->name }}</p>
    <p><strong>Thời gian:</strong> {{ $post->created_at->format('d/m/Y H:i') }}</p>

    <div>{!! nl2br(e($post->content)) !!}</div>

    @if ($post->image)
        <div class="mt-3">
            <img src="{{ asset('storage/' . $post->image) }}" width="400">
        </div>
    @endif

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
@endsection
