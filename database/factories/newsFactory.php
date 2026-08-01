<?php

namespace Database\Factories;

use App\Models\news;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\NewsCategory;

class newsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = news::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $newsCategory = NewsCategory::first();
        if (!$newsCategory) {
            $newsCategory = NewsCategory::factory()->create();
        }

        return [
            'news_category_id' => $this->faker->word,
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'tagline' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'date' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'short_description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'gallery' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'custom_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'new_window' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
