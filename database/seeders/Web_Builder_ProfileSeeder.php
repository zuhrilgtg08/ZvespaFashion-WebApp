<?php

namespace Database\Seeders;
use App\Models\Web_Builder\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Web_Builder_ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'karyawan_id' => 4,
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat',
            'visi' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Modi',
            'misi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur',
        ]);
    }
}
