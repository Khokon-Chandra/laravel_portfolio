<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author'=>User::factory(),
            'title'=>$this->faker->text(100),
            'description'=>$this->faker->text(500),
            'image'=>$this->faker->imageUrl(400,400),
            'post_container'=>Category::factory(),
        ];
    }
}
