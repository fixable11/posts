<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Comment.
 */
class Comment extends Model
{
    /**
     * @var array $guarded Guarded fields.
     */
    protected $guarded = [];

    /**
     * Comment belongs to post.
     *
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
