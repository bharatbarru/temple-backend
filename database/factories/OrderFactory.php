<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PaymentMethod;
use App\Models\Coupon;
use App\Models\Customer;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $customer = Customer::first();
        if (!$customer) {
            $customer = Customer::factory()->create();
        }

        return [
            'orderid' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'customer_id' => $this->faker->word,
            'guest_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'guest_email' => $this->faker->email,
            'guest_phone' => $this->faker->numerify('0##########'),
            'order_type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'subtotal_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'coupon_discount' => $this->faker->numberBetween(0, 9223372036854775807),
            'royalty_points_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'tax_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'delivery_charge' => $this->faker->numberBetween(0, 9223372036854775807),
            'total_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'coupon_id' => $this->faker->word,
            'delivery_address' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'contact_number' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'payment_method_id' => $this->faker->word,
            'transaction_id' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'payment_status' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'order_status' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'reason_for_cancellation' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'order_date' => $this->faker->date('Y-m-d'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
