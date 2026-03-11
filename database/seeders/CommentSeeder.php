<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $comments = [
            ['post_id' => 1, 'user_id' => 2, 'body' => 'Great article! Very helpful for getting started with Laravel.'],
            ['post_id' => 1, 'user_id' => 3, 'body' => 'I have been using Laravel for years and this is a great summary.'],
            ['post_id' => 2, 'user_id' => 2, 'body' => 'I visited Bali last year and it was amazing! Great recommendations.'],
            ['post_id' => 3, 'user_id' => 3, 'body' => 'The carbonara recipe looks delicious, can not wait to try it!'],
            ['post_id' => 4, 'user_id' => 2, 'body' => 'These tips are really practical and easy to follow. Thanks!'],
            ['post_id' => 5, 'user_id' => 3, 'body' => 'Number 3 tip blew my mind. I never thought of doing it that way.'],
            ['post_id' => 6, 'user_id' => 2, 'body' => 'Starting a business is tough but this guide makes it less intimidating.'],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
