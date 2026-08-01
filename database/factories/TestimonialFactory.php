<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\TestimonialCategory;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $testimonialCategory = TestimonialCategory::first();
        if (!$testimonialCategory) {
            $testimonialCategory = TestimonialCategory::factory()->create();
        }

        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'company' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'designation' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'date' => $this->faker->date('Y-m-d'),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'icon' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'video_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'video_iframe' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'short_description' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'custom_url' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'new_window' => $this->faker->boolean,
            'testimonial_category_id' => $this->faker->word
        ];
    }
}
