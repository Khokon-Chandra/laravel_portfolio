<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fname'=>$this->faker->firstName,
            'lname'=>$this->faker->lastName,
            'email'=>$this->faker->email,
            'password'=>$this->faker->password,
            'role'=>$this->faker->jobTitle,
        ];
    }
}
