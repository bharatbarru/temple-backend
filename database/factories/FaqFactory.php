<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\FaqCategory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faqCategory = FaqCategory::first();
        if (!$faqCategory) {
            $faqCategory = FaqCategory::factory()->create();
        }

        return [
            'faq_categories_id' => $this->faker->word,
            'question' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'answer' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'button_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'button_url' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'new_window' => $this->faker->boolean,
            'sort' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
