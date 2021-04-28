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
            "name"       => $this->faker->word,
            "email"      => $this->faker->word,
            "password"   => $this->faker->word,
            "is_active"  => $this->faker->word,
            "photo"      => $this->faker->word,
            "created_at" => $this->faker->date("Y-m-d H:i:s"),
            "updated_at" => $this->faker->date("Y-m-d H:i:s"),
        ];
    }
}
