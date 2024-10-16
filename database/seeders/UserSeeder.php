<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new User();
        $obj->name = "User";
        $obj->email = "user@gmail.com";
        $obj->password = Hash::make("12345678");
        $obj->save();
    }
}
