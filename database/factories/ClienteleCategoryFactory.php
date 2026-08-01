<?php

namespace Database\Factories;

use App\Models\ClienteleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;


class ClienteleCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClienteleCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'display_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'tagline' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'icon' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
