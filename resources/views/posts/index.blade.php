@extends('layouts.app')

@section('content')
    <h2>Danh sách bài viết</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Thêm bài viết</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Thể loại</th>
                <th>Người viết</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">Xem</a>

                         @canManagePost($post)
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Xoá bài này?')">Xoá</button>
                        </form>
                         @endcanManagePost
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Chưa có bài viết.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
