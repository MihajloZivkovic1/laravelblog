<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title'       => 'Getting Started with Laravel 12',
                'body'        => 'Laravel 12 brings many exciting features to the table. In this post we will explore the new features and how to get started with the latest version of Laravel. Laravel continues to be one of the most popular PHP frameworks, known for its elegant syntax and powerful features. The framework provides tools needed for large, robust applications.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [1, 2],
            ],
            [
                'title'       => 'Top 10 Travel Destinations in 2026',
                'body'        => 'Traveling the world is one of the most enriching experiences a person can have. In this post we explore the top 10 destinations you should visit in 2026. From the beaches of Southeast Asia to the mountains of South America, there is something for every type of traveler. Make sure to plan your trips in advance to get the best deals on flights and accommodation.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4],
            ],
            [
                'title'       => 'The Best Pasta Recipes You Need to Try',
                'body'        => 'Pasta is one of the most versatile and beloved foods in the world. Whether you prefer a classic carbonara or a hearty bolognese, there is a pasta dish for everyone. In this post we share our favorite pasta recipes that are easy to make at home. These recipes use simple ingredients that you can find at any grocery store.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5],
            ],
            [
                'title'       => 'How to Live a Healthier Lifestyle',
                'body'        => 'Living a healthy lifestyle does not have to be complicated. Small changes in your daily routine can have a big impact on your overall health and wellbeing. In this post we share practical tips for eating better, exercising more, and reducing stress. Start with small steps and gradually build healthy habits that will last a lifetime.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 8],
            ],
            [
                'title'       => 'JavaScript Tips Every Developer Should Know',
                'body'        => 'JavaScript is one of the most widely used programming languages in the world. Whether you are a beginner or an experienced developer, there is always something new to learn. In this post we share some essential JavaScript tips and tricks that will help you write better, cleaner code. These tips cover everything from ES6 features to performance optimization.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [1, 3],
            ],
            [
                'title'       => 'Building Your First Business — A Beginner Guide',
                'body'        => 'Starting a business can be one of the most rewarding and challenging things you will ever do. In this post we share a step by step guide for aspiring entrepreneurs who want to turn their ideas into reality. From writing a business plan to finding your first customers, we cover everything you need to know to get started on your entrepreneurial journey.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'Draft Post — Work in Progress',
                'body'        => 'This post is still being written and is not yet ready for publication.',
                'category_id' => 1,
                'status'      => 'draft',
                'tags'        => [1],
            ],
        ];

        foreach ($posts as $data) {
            $tags = $data['tags'];
            unset($data['tags']);

            $post = Post::create(array_merge($data, [
                'user_id' => 1,
                'slug'    => \Str::slug($data['title']),
            ]));

            $post->tags()->sync($tags);
        }
    }
}
