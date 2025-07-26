@extends('layouts.app')

@section('content')
    <h2>Thêm bài viết</h2>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('posts.form', ['post' => null])

        <button type="submit" class="btn btn-success">Tạo bài viết</button>
    </form>
@endsection
