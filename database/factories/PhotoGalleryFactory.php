<?php

namespace Database\Factories;

use App\Models\PhotoGallery;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PhotoGalleryCategory;

class PhotoGalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhotoGallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $photoGalleryCategory = PhotoGalleryCategory::first();
        if (!$photoGalleryCategory) {
            $photoGalleryCategory = PhotoGalleryCategory::factory()->create();
        }

        return [
            'photo_category_id' => $this->faker->word,
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'sort' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
