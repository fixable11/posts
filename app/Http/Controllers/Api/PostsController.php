<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Filesystem\ImageUploader;
use App\Http\Requests\Posts\CreateRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Model\Post;
use App\Service\PostService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * Class PostController.
 */
class PostsController
{
    /**
     * @var PostService $postService PostService.
     */
    private $postService;

    /**
     * PostController constructor.
     *
     * @param PostService $postService PostService.
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * List of posts.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $posts = $this->postService->getAllPosts();

        return PostResource::collection($posts);
    }

    /**
     * Store post.
     *
     * @param CreateRequest $request Request.
     *
     * @return PostResource
     */
    public function store(CreateRequest $request)
    {
        $post = $this->postService->createPost($request->validated());

        return new PostResource($post);
    }

    /**
     * Show post.
     *
     * @param Post $post Post.
     *
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update post.
     *
     * @param UpdateRequest $request Request.
     * @param Post          $post    Post.
     *
     * @return PostResource
     * @throws \Exception
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $this->postService->updatePost($post, $request->validated());

        return new PostResource($post);
    }

    /**
     * Remove post.
     *
     * @param Post $post
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);

        return response()->json([], 204);
    }
}
