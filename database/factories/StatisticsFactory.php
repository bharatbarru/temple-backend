<?php

namespace Database\Factories;

use App\Models\Statistics;
use Illuminate\Database\Eloquent\Factories\Factory;


class StatisticsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statistics::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'number' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'prefix' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'suffix' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'url' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'new_window' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
