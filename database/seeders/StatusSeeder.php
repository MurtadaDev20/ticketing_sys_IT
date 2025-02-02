<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            // ['name' => 'Pending'],
            // ['name' => 'In Progress'],
            // ['name' => 'Complete'],
            ['name' => 'needs approval'],
            ['name' => 'approved'],
            ['name' => 'rejected'],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
