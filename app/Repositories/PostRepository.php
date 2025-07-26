<?php


namespace App\Repositories;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\DatabaseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Exception;

class PostRepository implements PostRepositoryInterface
{
    public function getAll()
    {
        return Post::with(['category', 'user'])->latest()->get();
    }

    public function find($id)
    {
        try {
            return Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Log::warning("Post not found with ID: {$id}");
            throw new NotFoundException("Post with ID {$id} not found.");
        }
    }

    public function create(array $data)
    {
        try {
            return Post::create($data);
        } catch (Exception $e) {
            Log::error("Post creation failed: " . $e->getMessage());
            throw new DatabaseException("Failed to create post.");
        }
    }

    public function update($id, array $data)
    {
        try {
            $post = Post::findOrFail($id);
            $post->update($data);
            return $post;
        } catch (ModelNotFoundException $e) {
            Log::warning("Post not found when updating. ID: {$id}");
            throw new NotFoundException("Post with ID {$id} not found.");
        } catch (Exception $e) {
            Log::error("Post update failed: " . $e->getMessage());
            throw new DatabaseException("Failed to update post.");
        }
    }

    public function delete($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::warning("Post not found when deleting. ID: {$id}");
            throw new NotFoundException("Post with ID {$id} not found.");
        } catch (Exception $e) {
            Log::error("Post deletion failed: " . $e->getMessage());
            throw new DatabaseException("Failed to delete post.");
        }
    }
}
