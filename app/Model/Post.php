<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Post.
 */
class Post extends Model
{
    /**
     * @var array $guarded Guarded fields.
     */
    protected $guarded = [];

    /**
     * Post has many comments.
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Posts belongs to author.
     *
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
