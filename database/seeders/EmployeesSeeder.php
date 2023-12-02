<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employees;
use App\Models\Company;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 20; $i++) {
            Employees::create([
                'first_nm' => $faker->firstName,
                'last_nm' => $faker->lastName,
                'company_id' => Company::all()->random()->id,
                'email'  => $faker->email,
                'phone'  => $faker->phoneNumber,
            ]);
        }
    }
}
