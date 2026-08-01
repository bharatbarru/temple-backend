<?php

namespace Database\Factories;

use App\Models\Clientele;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ClienteleCategory;

class ClienteleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clientele::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $clienteleCategory = ClienteleCategory::first();
        if (!$clienteleCategory) {
            $clienteleCategory = ClienteleCategory::factory()->create();
        }

        return [
            'clientele_category_id' => $clienteleCategory->id,
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'title' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'sub_title' => $this->faker->text($this->faker->numberBetween(5, 535)),
            'url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'new_window' => $this->faker->boolean,
            'publish' => $this->faker->boolean,
            'sort' => 1,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
