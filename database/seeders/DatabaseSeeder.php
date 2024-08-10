<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Jabatan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Customer::insert([
            [
                "name" => "Daihatsu",
                "code" => "adm",
            ],
            [
                "name" => "Toyota",
                "code" => "tmmin",
            ],
            [
                "name" => "Honda",
                "code" => "hpm",
            ],
            [
                "name" => "Yamaha",
                "code" => "yimm",
            ],
            [
                "name" => "Suzuki R2",
                "code" => "sim-r2",
            ],
            [
                "name" => "Suzuki R4",
                "code" => "sim-r4",
            ],
            [
                "name" => "Hyundai",
                "code" => "hmi",
            ],
            [
                "name" => "Hino",
                "code" => "hino",
            ],
            [
                "name" => "Kawasaki",
                "code" => "kmi",
            ],
            [
                "name" => "Alva",
                "code" => "alva",
            ],
            ]);
        // User::factory(10)->create();
        User::create([
            "username"=> "Anton",
            "customer_id"=> 1,
            "password"=> bcrypt("M371nd0root"),
            "jabatan"=> "admin",
        ]);
    }
}
