<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Comments\CreateRequest;
use App\Http\Requests\Comments\UpdateRequest;
use App\Http\Resources\CommentResource;
use App\Model\Comment;
use App\Model\Post;
use App\Service\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class CommentsController.
 */
class CommentsController
{
    /**
     * @var CommentService $commentService CommentService.
     */
    private $commentService;

    /**
     * PostController constructor.
     *
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * List of comments.
     *
     * @param Post $post
     *
     * @return AnonymousResourceCollection
     */
    public function index(Post $post)
    {
        $posts = $this->commentService->getAllComments($post);

        return CommentResource::collection($posts);
    }

    /**
     * Store post.
     *
     * @param CreateRequest $request Request.
     * @param Post          $post    Post.
     *
     * @return CommentResource
     */
    public function store(CreateRequest $request, Post $post)
    {
        $post = $this->commentService->createComment($post, $request->validated());

        return new CommentResource($post);
    }

    /**
     * Show post.
     *
     * @param Post    $post    Post.
     * @param Comment $comment Comment.
     *
     * @return CommentResource
     */
    public function show(Post $post, Comment $comment)
    {
        $comment = $this->commentService->getComment($post, $comment);

        return new CommentResource($comment);
    }

    /**
     * Update post.
     *
     * @param UpdateRequest $request Request.
     * @param Post          $post    Post.
     * @param Comment       $comment Comment.
     *
     * @return CommentResource
     */
    public function update(UpdateRequest $request, Post $post, Comment $comment)
    {
        $comment = $this->commentService->updateComment($post, $comment, $request->validated());

        return new CommentResource($comment);
    }

    /**
     * Remove post.
     *
     * @param Post    $post    Post.
     * @param Comment $comment Comment.
     *
     * @return JsonResponse
     *
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->commentService->deleteComment($post, $comment);

        return response()->json([], 204);
    }
}
