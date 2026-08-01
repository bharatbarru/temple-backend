<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;


class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'coupon_code' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'discount_type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'discount_value' => $this->faker->numberBetween(0, 9223372036854775807),
            'min_order_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'valid_from' => $this->faker->date('Y-m-d'),
            'valid_until' => $this->faker->date('Y-m-d'),
            'usage_limit' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
