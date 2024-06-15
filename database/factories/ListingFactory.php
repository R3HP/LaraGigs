<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'id' => fake()->name(),
            'title' => fake()->jobTitle(),
            'tags' => 'Laravel,Php,Html',
            'company' =>fake()->company(),
            'location' => fake()->city(),
            'email' => $this->faker->companyEmail(),
            'website' => fake()->url(),
            'description' => fake()->paragraph(5)
        ];
    }
}
