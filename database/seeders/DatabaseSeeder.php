<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory()->count(20)->create();
        $tags = Tag::factory()->count(50)->create();
        Category::factory()->count(200)->create();
        // \App\Models\User::factory(10)->create();

        foreach ($posts as $post) {
            $tagsIds = $tags->random(5)->pluck('id')->toArray();
            $post->tags()->syncWithoutDetaching($tagsIds);
        }
    }
}
