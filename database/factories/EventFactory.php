<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\EventCategory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $eventCategory = EventCategory::first();
        if (!$eventCategory) {
            $eventCategory = EventCategory::factory()->create();
        }

        return [
            'event_category_id' => $this->faker->word,
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'start_date_time' => $this->faker->date('Y-m-d H:i:s'),
            'end_date_time' => $this->faker->date('Y-m-d H:i:s'),
            'short_description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'custom_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'seo_title' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'seo_keywords' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'seo_description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'sort' => $this->faker->word,
            'publish' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
