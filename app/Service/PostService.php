<?php

declare(strict_types=1);

namespace App\Service;

use App\Filesystem\ImageUploader;
use App\Model\Author;
use App\Model\Post;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class PostService.
 */
class PostService
{
    /**
     * @var ImageUploader $imageUploader ImageUploader.
     */
    private $imageUploader;

    /**
     * PostService constructor.
     *
     * @param ImageUploader $imageUploader ImageUploader.
     */
    public function __construct(ImageUploader $imageUploader)
    {
        $this->imageUploader = $imageUploader;
    }

    /**
     * Get all posts.
     *
     * @return Post[]|Collection
     */
    public function getAllPosts()
    {
        return Post::with('comments')->get();
    }

    /**
     * Create post.
     *
     * @param array $data Validated data.
     *
     * @return Post
     * @throws Exception
     */
    public function createPost(array $data)
    {
        $post = new Post();
        $data['image'] = $this->imageUploader->uploadBase64Image($data['image']);
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
     * @throws Exception
     */
    public function updatePost(Post $post, array $data)
    {
        $data['image'] = $this->imageUploader->uploadBase64Image($data['image']);
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
     * @throws Exception
     */
    public function deletePost(Post $post)
    {
        DB::transaction(function () use ($post) {
            $post->delete();
        });
    }
}
