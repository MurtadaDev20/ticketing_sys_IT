<?php

namespace Database\Seeders;

use App\Models\support;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new support();
        $obj->name = "Support";
        $obj->email = "support@gmail.com";
        $obj->password = Hash::make("12345678");
        $obj->save();
    }
}
