<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text(100),
            'description'=>$this->faker->text(500),
            'image'=>$this->faker->imageUrl(300,400),
            'price'=>$this->faker->randomDigit()
        ];
    }
}
