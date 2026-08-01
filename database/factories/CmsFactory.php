<?php

namespace Database\Factories;

use App\Models\Cms;
use Illuminate\Database\Eloquent\Factories\Factory;


class CmsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cms::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'parent' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'custom_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'banner_image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'banner_image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'banner_title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'banner_tagline' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'short_description' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'content' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'gallery' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'main_menu' => $this->faker->boolean,
            'top_menu' => $this->faker->boolean,
            'side_menu' => $this->faker->boolean,
            'footer_menu' => $this->faker->boolean,
            'seo_title' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'seo_keywords' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'seo_description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'publish' => $this->faker->boolean,
            'sort' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
