<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'content' => $this->faker->text(100),
            'image' => $this->faker->imageUrl(640, 480),
            'likes' => random_int(1, 2000),
            'is_published' => 1,
            'category_id' => Category::get()->random()->id,
        ];
    }
}
