<?php

namespace Database\Factories;

use App\Models\TempleTour;
use Illuminate\Database\Eloquent\Factories\Factory;


class TempleTourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TempleTour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'tour_request_id' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'tour_date' => $this->faker->date('Y-m-d'),
            'tour_time' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'alternate_tour_date' => $this->faker->date('Y-m-d'),
            'alternate_tour_time' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'email' => $this->faker->email,
            'mobile' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'total_visitors' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'age_range_of_group' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'last_visit_to_temple' => $this->faker->boolean,
            'comment' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'admin_comments' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'terms_conditions' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
