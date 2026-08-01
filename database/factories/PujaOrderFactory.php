<?php

namespace Database\Factories;

use App\Models\PujaOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\FrontendUser;

class PujaOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PujaOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $frontendUser = FrontendUser::first();
        if (!$frontendUser) {
            $frontendUser = FrontendUser::factory()->create();
        }

        return [
            'puja_request_id' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'user_id' => $this->faker->word,
            'puja_location' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'date_of_puja' => $this->faker->date('Y-m-d'),
            'time_of_puja' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'alternate_date_of_puja1' => $this->faker->date('Y-m-d'),
            'alternate_time_of_puja2' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'total_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'priest_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'comments' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'admin_comments' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'cancelled_by' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'cancelled_comments' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'changed_by' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'changed_comments' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'payment_status' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'terms_conditions' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
