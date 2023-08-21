<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();

        $users->each(function ($user) {
            $companies = $user->companies()->saveMany(
                Company::factory()->count(rand(0, 5))
                    ->make()
            );

            $companies->each(function ($company) use ($user) {
                $company->contacts()->saveMany(
                    Contact::factory()->count(10)
                        ->make()
                        ->map(function ($contact) use ($user) {
                            $contact->user_id = $user->id;
                            return $contact;
                        })
                );
            });
        });
    }
}
