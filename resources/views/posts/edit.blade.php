@extends('layouts.app')

@section('content')
    <h2>Sửa bài viết</h2>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        @include('posts.form', ['post' => $post])

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
