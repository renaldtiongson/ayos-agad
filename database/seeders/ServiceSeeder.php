<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::insert([
            [
                'service_name' => 'Plumbing',
                'description' => 'Pipe installation, leak repair, and water system maintenance.',
                'base_price' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_name' => 'Electrical',
                'description' => 'Electrical wiring, repairs, and installations.',
                'base_price' => 700.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_name' => 'Carpentry',
                'description' => 'Woodwork, furniture repair, and custom carpentry.',
                'base_price' => 600.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_name' => 'Painting',
                'description' => 'Interior and exterior painting services.',
                'base_price' => 800.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}