<?php

namespace Database\Factories;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;


class HallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hall::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'monday_cost' => $this->faker->numberBetween(0, 9223372036854775807),
            'tuesday_cost' => $this->faker->numberBetween(0, 9223372036854775807),
            'wednesday_cost' => $this->faker->numberBetween(0, 9223372036854775807),
            'thursday_cost' => $this->faker->numberBetween(0, 9223372036854775807),
            'friday_cost' => $this->faker->numberBetween(0, 9223372036854775807),
            'saturday_cost' => $this->faker->numberBetween(0, 9223372036854775807),
            'sunday_cost' => $this->faker->numberBetween(0, 9223372036854775807),
            'sort' => $this->faker->word,
            'publish' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
