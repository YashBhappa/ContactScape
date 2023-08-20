<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->company,
            "address" => $this->faker->address,
            "email" => $this->faker->email,
            "website" => $this->faker->domainName,
            "created_at" => $this->faker->dateTimeThisDecade(),
            "updated_at" => $this->faker->dateTimeThisMonth(),
            "user_id" => User::factory(),
        ];
    }
}
