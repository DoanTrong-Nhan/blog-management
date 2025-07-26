<?php


namespace App\Services;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService implements PostServiceInterface
{
    protected $repo;

    public function __construct(PostRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function list($perPage = 6, $search = null)
    {
        return $this->repo->getPaginated($perPage, $search);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('images', 'public');
        }

        $data['user_id'] = Auth::id();
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->repo->find($id);

        if (Auth::user()->role->name !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền sửa bài viết này.');
        }

        if (isset($data['image'])) {
            Storage::disk('public')->delete($post->image);
            $data['image'] = $data['image']->store('images', 'public');
        }

        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        $post = $this->repo->find($id);

        if (Auth::user()->role->name !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xoá bài viết này.');
        }

        Storage::disk('public')->delete($post->image);
        return $this->repo->delete($id);
    }


}
