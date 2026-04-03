<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $comments = [
            // Technology posts
            ['post_id' => 1,  'user_id' => 2, 'body' => 'Great article! Very helpful for getting started with Laravel 12.'],
            ['post_id' => 1,  'user_id' => 3, 'body' => 'I have been using Laravel for years and this is a great summary of what\'s new.'],
            ['post_id' => 2,  'user_id' => 3, 'body' => 'The optional chaining tip alone saved me so much boilerplate. Excellent post.'],
            ['post_id' => 3,  'user_id' => 2, 'body' => 'Sanctum has completely replaced Passport for me. This tutorial is spot on.'],
            ['post_id' => 4,  'user_id' => 3, 'body' => 'Typed class constants are a game changer. Finally!'],
            ['post_id' => 5,  'user_id' => 2, 'body' => 'The section on hasManyThrough cleared up something I have been confused about for months.'],
            ['post_id' => 6,  'user_id' => 3, 'body' => 'Composables feel so much cleaner than mixins ever did. Great write-up.'],
            ['post_id' => 7,  'user_id' => 2, 'body' => 'The Docker setup worked perfectly first try. Really appreciate the detail here.'],
            ['post_id' => 8,  'user_id' => 3, 'body' => 'SOLID principles explained clearly without being overly academic. Bookmarked.'],
            ['post_id' => 9,  'user_id' => 2, 'body' => 'Cache invalidation is always the hard part. Great tips on using tags.'],
            ['post_id' => 10, 'user_id' => 3, 'body' => 'TDD felt weird at first but now I cannot imagine shipping without tests.'],

            // Travel posts
            ['post_id' => 11, 'user_id' => 2, 'body' => 'I visited Bali last year and it was absolutely magical. Great recommendations.'],
            ['post_id' => 11, 'user_id' => 3, 'body' => 'Adding this list to my travel bucket list immediately!'],
            ['post_id' => 12, 'user_id' => 2, 'body' => 'Budapest is criminally underrated. Spent two weeks there and barely spent anything.'],
            ['post_id' => 13, 'user_id' => 3, 'body' => 'The JR Pass tip is something every first-time Japan visitor needs to read.'],
            ['post_id' => 14, 'user_id' => 2, 'body' => 'Safety planning is so important. More people should read this before going solo.'],
            ['post_id' => 15, 'user_id' => 3, 'body' => 'El Nido in the Philippines is otherworldly. Glad it made the list.'],
            ['post_id' => 17, 'user_id' => 2, 'body' => 'Albania is so underrated. I went last summer and it was phenomenal.'],
            ['post_id' => 18, 'user_id' => 3, 'body' => 'Packing cubes changed my life. I travel carry-on only everywhere now.'],
            ['post_id' => 20, 'user_id' => 2, 'body' => 'Tbilisi has such fast internet and the cost of living is unbelievable.'],

            // Food posts
            ['post_id' => 21, 'user_id' => 3, 'body' => 'The carbonara recipe looks delicious. Cannot wait to try it this weekend!'],
            ['post_id' => 22, 'user_id' => 2, 'body' => 'My first sourdough loaf was a disaster but this guide helped me nail the second one.'],
            ['post_id' => 22, 'user_id' => 3, 'body' => 'The starter maintenance section is the best explanation I have found online.'],
            ['post_id' => 23, 'user_id' => 2, 'body' => 'Takoyaki in Osaka is on another level. Great post!'],
            ['post_id' => 24, 'user_id' => 3, 'body' => 'The Thai basil chicken recipe is now on permanent weeknight rotation in our house.'],
            ['post_id' => 25, 'user_id' => 2, 'body' => 'I never knew water temperature mattered so much for pour-over. Mind blown.'],
            ['post_id' => 26, 'user_id' => 3, 'body' => 'The black bean chili is incredible. Even my meat-eating partner loved it.'],
            ['post_id' => 27, 'user_id' => 2, 'body' => 'Pulled this off for 8 people at under €15 per head. Absolute winner.'],
            ['post_id' => 28, 'user_id' => 3, 'body' => 'Made the kimchi last week, already obsessed with the process.'],
            ['post_id' => 30, 'user_id' => 2, 'body' => 'Never knew I was holding my knife wrong until I read this. Total difference.'],

            // Lifestyle posts
            ['post_id' => 31, 'user_id' => 3, 'body' => 'These tips are really practical and easy to follow. Thanks for sharing.'],
            ['post_id' => 32, 'user_id' => 2, 'body' => 'Delaying my phone for 30 minutes after waking up changed everything for me.'],
            ['post_id' => 33, 'user_id' => 3, 'body' => 'Cleared out two bin bags from my wardrobe after reading this. Feels amazing.'],
            ['post_id' => 34, 'user_id' => 2, 'body' => 'The 20-page rule is so simple but so effective. I have finished 18 books this year.'],
            ['post_id' => 35, 'user_id' => 3, 'body' => 'The 4-7-8 breathing method works instantly. Game changer for anxious moments.'],
            ['post_id' => 36, 'user_id' => 2, 'body' => 'Composting is easier than I expected and makes a real difference.'],
            ['post_id' => 37, 'user_id' => 3, 'body' => 'Did a 48-hour detox last month. The first few hours were tough but then I felt amazing.'],
            ['post_id' => 38, 'user_id' => 2, 'body' => 'Morning pages have been part of my routine for a year now. Cannot recommend enough.'],
            ['post_id' => 39, 'user_id' => 3, 'body' => 'Keeping the bedroom cool is the most underrated sleep tip. Works every time.'],
            ['post_id' => 40, 'user_id' => 2, 'body' => 'The reframe from "balance" to "integration" really resonated with me.'],

            // Business posts
            ['post_id' => 41, 'user_id' => 3, 'body' => 'Starting a business is tough but this guide makes it feel achievable.'],
            ['post_id' => 42, 'user_id' => 2, 'body' => 'The concierge MVP idea saved me from building a product nobody wanted.'],
            ['post_id' => 43, 'user_id' => 3, 'body' => 'The feast-or-famine section is so real. Retainer agreements fixed this for me.'],
            ['post_id' => 44, 'user_id' => 2, 'body' => 'Distribution is where most content strategies fall apart. Great point.'],
            ['post_id' => 45, 'user_id' => 3, 'body' => 'Started my emergency fund after reading this. Six months in and already feel more secure.'],
            ['post_id' => 46, 'user_id' => 2, 'body' => 'The executive summary section alone was worth the read. Very actionable.'],
            ['post_id' => 47, 'user_id' => 3, 'body' => 'Organic reach on LinkedIn is still surprisingly strong in 2026.'],
            ['post_id' => 48, 'user_id' => 2, 'body' => 'Time blocking changed how I run my week. Highly recommend trying it for a month.'],
            ['post_id' => 49, 'user_id' => 3, 'body' => 'NRR is the metric I wish I had focused on earlier. Great breakdown.'],
            ['post_id' => 50, 'user_id' => 2, 'body' => 'The structured interview format is something I will be using for every hire going forward.'],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
