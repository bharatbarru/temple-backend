<?php

namespace Database\Factories;

use App\Models\HallOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\HallEventType;
use App\Models\FrontendUser;

class HallOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HallOrder::class;

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
            'hall_request_id' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'type_of_event' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'user_id' => $this->faker->word,
            'hall_event_type_id' => $this->faker->word,
            'other_event_type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'date_of_event' => $this->faker->date('Y-m-d'),
            'alternate_date_of_event' => $this->faker->date('Y-m-d'),
            'start_time' => $this->faker->date('H:i:s'),
            'duration' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'comments' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'total_amount' => $this->faker->numberBetween(0, 9223372036854775807),
            'admin_comments' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'cancelled_by' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'cancelled_comments' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'changed_by' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'changed_comments' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'payment_status' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'terms_conditions' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
