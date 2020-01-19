<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Comment;
use App\Model\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentService.
 */
class CommentService
{
    /**
     * Get all comments of the post.
     *
     * @param Post $post Post.
     *
     * @return Collection
     */
    public function getAllComments(Post $post)
    {
        return $post->comments()->get();
    }

    /**
     * Get the specific comment.
     *
     * @param Post    $post
     * @param Comment $comment
     *
     * @return Collection|Model|HasMany|HasMany[]
     */
    public function getComment(Post $post, Comment $comment)
    {
        return $post->comments()->findOrFail($comment->id);
    }

    /**
     * Create comment.
     *
     * @param Post  $post Post.
     * @param array $data Validated data.
     *
     * @return Comment
     */
    public function createComment(Post $post, array $data)
    {
        $comment = new Comment();
        DB::transaction(function () use ($data, $post, $comment) {
            $comment->fill($data);
            $post->comments()->save($comment);
        });

        return $comment;
    }

    /**
     * Update post.
     *
     * @param Post    $post    Post.
     * @param Comment $comment Comment.
     * @param array   $data    Validated data.
     *
     * @return Comment|Model|HasMany
     */
    public function updateComment(Post $post, Comment $comment, array $data)
    {
        $comment = $post->comments()->findOrFail($comment->id);
        DB::transaction(function () use ($comment, $data) {
            $comment->update($data);
        });

        return $comment;
    }

    /**
     * Delete comment.
     *
     * @param Post    $post    Post.
     * @param Comment $comment Comment.
     */
    public function deleteComment(Post $post, Comment $comment)
    {
        $comment = $post->comments()->findOrFail($comment->id);
        DB::transaction(function () use ($comment) {
            $comment->delete();
        });
    }
}
