<?php

namespace Database\Factories;

use App\Models\Contributor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContributorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contributor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'civility' => 'not_specified',
            'last_name' => $this->faker->sentence(1),
            'first_name' => $this->faker->sentence(1),
            'street' => $this->faker->sentence(2),
            'zip_code' => $this->faker->randomNumber(5),
            'city' => $this->faker->sentence(1),
            'phone' => $this->faker->unique()->randomNumber(),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
