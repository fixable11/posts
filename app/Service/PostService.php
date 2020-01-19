<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Author;
use App\Model\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class PostService.
 */
class PostService
{
    /**
     * Get all posts.
     *
     * @return Post[]|Collection
     */
    public function getAllPosts()
    {
        return Post::all();
    }

    /**
     * Create post.
     *
     * @param array $data Validated data.
     *
     * @return Post
     */
    public function createPost(array $data)
    {
        $post = new Post();
        DB::transaction(function () use ($data, $post) {
            $post->fill($data);
            $post->author_id = rand(1, 5);
            $post->save();
        });

        return $post;
    }

    /**
     * Update post.
     *
     * @param Post  $post Post.
     * @param array $data Validated data.
     *
     * @return Post
     */
    public function updatePost(Post $post, array $data)
    {
        DB::transaction(function () use ($data, $post) {
            $post->update($data);
        });

        return $post;
    }

    /**
     * Delete post.
     *
     * @param Post $post Post.
     *
     * @throws \Exception
     */
    public function deletePost(Post $post)
    {
        DB::transaction(function () use ($post) {
            $post->delete();
        });
    }
}
