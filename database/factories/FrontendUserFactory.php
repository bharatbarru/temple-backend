<?php

namespace Database\Factories;

use App\Models\FrontendUser;
use Illuminate\Database\Eloquent\Factories\Factory;


class FrontendUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FrontendUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'mobile' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'email' => $this->faker->email,
            'address' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'country' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'state' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'city' => $this->faker->word,
            'pincode' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'dob' => $this->faker->date('Y-m-d'),
            'rashi' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'birth_star' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'gothram' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'spouse_name' => $this->faker->lastName,
            'children_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'publish' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
