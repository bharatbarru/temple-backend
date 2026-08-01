<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ProductCategory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productCategory = ProductCategory::first();
        if (!$productCategory) {
            $productCategory = ProductCategory::factory()->create();
        }

        return [
            'product_category_id' => $this->faker->word,
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'sub_title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'post_date' => $this->faker->date('Y-m-d H:i:s'),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'short_description' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_gallery' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'video_gallery' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'video_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'video_iframe' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'custom_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'map_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'map_iframe' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'page_title' => $this->faker->text($this->faker->numberBetween(5, 65535)),
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
