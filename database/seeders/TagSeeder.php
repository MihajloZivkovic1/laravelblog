<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['Laravel', 'PHP', 'JavaScript', 'Travel', 'Food', 'Health', 'Finance', 'Tips'];

        foreach ($tags as $name) {
            Tag::create([
                'name' => $name,
                'slug' => \Str::slug($name),
            ]);
        }
    }
}
