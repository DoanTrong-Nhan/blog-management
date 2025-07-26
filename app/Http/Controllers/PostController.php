<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostServiceInterface;
use App\Models\Category;

class PostController extends Controller
{
    protected $service;

    public function __construct(PostServiceInterface $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index()
    {
        $search = request()->query('search');
        $posts = $this->service->list(6, $search);
        return view('posts.index', compact('posts', 'search'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('posts.index')->with('success', 'Tạo bài viết thành công');
    }

    public function edit($id)
    {
        $post = $this->service->find($id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('posts.index')->with('success', 'Xoá bài viết thành công');
    }

    public function show($id)
    {
        $post = $this->service->find($id);
        return view('posts.show', compact('post'));
    }
}
