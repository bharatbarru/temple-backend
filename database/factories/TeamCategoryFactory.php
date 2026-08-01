<?php

namespace Database\Factories;

use App\Models\TeamCategory;
use Illuminate\Database\Eloquent\Factories\Factory;


class TeamCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamCategory::class;

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
            'icon' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'sort' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
