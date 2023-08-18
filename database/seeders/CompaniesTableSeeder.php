<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('companies')->delete();

        // $companies = [];
        // $faker = Faker::create();

        // foreach (range(1, 100) as $index) {
        //     $companies[] = [
        //         'name' => $faker->company,
        //         'address' => $faker->address,
        //         'email' => $faker->email,
        //         'website' => $faker->domainName,
        //         'created_at' => $faker->dateTimeThisDecade(),
        //         'updated_at' => $faker->dateTimeThisMonth(),
        //     ];
        // }

        // DB::table('companies')->insert($companies);

        Company::factory()->count(10)->create();
    }
}
