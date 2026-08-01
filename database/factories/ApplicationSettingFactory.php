<?php

namespace Database\Factories;

use App\Models\ApplicationSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ApplicationSettingCategory;
use App\Models\ApplicationSettingType;

class ApplicationSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicationSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $applicationSettingType = ApplicationSettingType::first();
        if (!$applicationSettingType) {
            $applicationSettingType = ApplicationSettingType::factory()->create();
        }

        return [
            'field_name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'slug' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'input_type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'value' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'alt_text' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'options' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'application_setting_type_id' => 1,
            'application_setting_category_id' => null,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
