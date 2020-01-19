<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Author.
 */
class Author extends Model
{
    /**
     * @var array $guarded Guarded fields.
     */
    protected $guarded = [];

    /**
     * Author has many posts.
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
