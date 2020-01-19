<?php

use Illuminate\Database\Seeder;
use App\Model\Author;
use App\Model\Post;
use App\Model\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Author::class, 5)->create()->each(function (Author $author) {
            $posts = factory(Post::class, 5)->make();
            $author->posts()->saveMany($posts);
            $posts->each(function (Post $post) {
                $comments = factory(Comment::class, 5)->make();
                $post->comments()->saveMany($comments);
            });
        });
    }
}
