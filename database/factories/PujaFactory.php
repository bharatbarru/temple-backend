<?php

namespace Database\Factories;

use App\Models\Puja;
use Illuminate\Database\Eloquent\Factories\Factory;


class PujaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Puja::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'home_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'temple_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'sort' => $this->faker->word,
            'publish' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
