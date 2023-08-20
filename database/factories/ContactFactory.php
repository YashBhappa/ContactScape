<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create(); // Create a new user

        return [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "phone" => $this->faker->phoneNumber,
            "email" => $this->faker->unique()->safeEmail,
            "address" => $this->faker->address,
            "position" => $this->faker->jobTitle,
            "city" => $this->faker->city,
            "country" => $this->faker->country,
            "interest" => $this->faker->numberBetween(1, 5),
            "channel" => $this->faker->randomElement(["email", "phone", "social"]),
            "company_id" => Company::pluck("id")->random(),
            "user_id" => $user->id, // Use the ID of the created user
        ];
    }
}
