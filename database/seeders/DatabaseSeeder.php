<?php

namespace Database\Seeders;
use App\Models\employees;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,500) as $index){
            DB::table('employees')->insert([
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
                'email' => $faker->email,
                'dob' => $faker->date($format = 'D-m-y', $max = '2010',$min = '1980')
            ]);
        }
    }
}
