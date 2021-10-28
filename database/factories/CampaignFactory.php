<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'total_budget' => $this->faker->numberBetween(500000, 10000000),
            'daily_budget' => $this->faker->numberBetween(1000, 30000),
            'start_date' => now(),
            'end_date' => now()->addMonth()
        ];
    }
}
