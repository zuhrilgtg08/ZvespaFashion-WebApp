<?php

namespace Database\Seeders;
use App\Models\Specifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        Specifications::create([
            'product_id' => 1,
            'engine' => 'single-cylinder, 4-stroke, 3 valves',
            'displacement' => '124.5 cc',
            'max_power' => '7.6 kW @ 7,600 rpm',
            'max_torque' => '10.2 Nm @ 6,000 rpm',
            'colling_system' => 'Forced Air',
            'transmission' => 'Automatic CVT (Continuous Variable Transmission)',
            'brake_system' => '110 mm drum brake',
            'front_tire' => 'Tubeless 110/70-11',
            'rear_tire' => 'Tubeless 120/70-10',
            'type_model' => '3 valves',
            'fuel_capacity' => '7.5 liter',
        ]);
    }
}
