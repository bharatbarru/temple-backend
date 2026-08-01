<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\TeamCategory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $teamCategory = TeamCategory::first();
        if (!$teamCategory) {
            $teamCategory = TeamCategory::factory()->create();
        }

        return [
            'team_categories_id' => $this->faker->word,
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'image_alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'designation' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'linkedin_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'facebook_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'instagram_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'twitter_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'github_url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'other' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'sort' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
