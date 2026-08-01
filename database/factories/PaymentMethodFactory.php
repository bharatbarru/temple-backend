<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;


class PaymentMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'payment_method_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'display_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'sandbox_key' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'sandbox_secret' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'live_key' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'live_secret' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'publish' => $this->faker->boolean,
            'sort' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
