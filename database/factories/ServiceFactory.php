<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ServiceCategory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $serviceCategory = ServiceCategory::first();
        if (!$serviceCategory) {
            $serviceCategory = ServiceCategory::factory()->create();
        }

        return [
            'service_category_id' => $this->faker->word,
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'sub_title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'short_description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'custom_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'new_window' => $this->faker->boolean,
            'gallery' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'video_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'video_iframe' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'page_title' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'seo_title' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'seo_keywords' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'seo_description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'icon' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'publish' => $this->faker->boolean,
            'sort' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
