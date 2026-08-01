<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;


class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'tagline' => $this->faker->text(500),
            'button_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'button_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
