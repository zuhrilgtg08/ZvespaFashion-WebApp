<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Dimas Firmansyah',
            'email' => 'dimasfirmansyah@gmail.com',
            'password' => bcrypt('dimas2023'),
            'alamat' => 'Jl Gadukan 12',
            'job' => 'Web Designer',
            'phone_number' => '0820-2431-3113',
            'profile_image' => null,
            'roles_type' => 0, //User
            'u_prov_id' => 11,
            'u_kota_id' => 133,
            'birthday' => null,
            'religion' => 'islam',
            'excerpt' => 'Bibendum letius sed auctor netus montes posuere nulla potenti...',
            'bio_user' => 'Bibendum letius sed auctor netus montes posuere nulla potenti odio nascetur sem interdum placerat sapien eu egestas taciti gravida habitasse',
        ]);

        User::create([
            'name' => 'Ahmad Zuhril Fahrizal',
            'email' => 'ahmadzuhril@gmail.com',
            'password' => bcrypt('adminzuhril2023'),
            'alamat' => 'Jl Gundih 2',
            'job' => 'Admin Staff',
            'phone_number' => '0823-4451-9013',
            'profile_image' => null,
            'roles_type' => 1, //Admin
            'u_prov_id' => 11,
            'u_kota_id' => 444,
            'birthday' => null,
            'religion' => 'islam',
            'excerpt' => 'Bibendum letius sed auctor netus montes posuere nulla potenti...',
            'bio_user' => 'Bibendum letius sed auctor netus montes posuere nulla potenti odio nascetur sem interdum placerat sapien eu egestas taciti gravida habitasse',
        ]);

        User::create([
            'name' => 'Nando Septian Prisandy',
            'email' => 'nandoseptian@gmail.com',
            'password' => bcrypt('karyawanNando2023'),
            'alamat' => 'Jl Rangkah 7',
            'job' => 'Frontend Developer',
            'phone_number' => '0841-9451-4112',
            'profile_image' => null,
            'roles_type' => 2, //Karyawan
            'u_prov_id' => 11,
            'u_kota_id' => 290,
            'birthday' => null,
            'religion' => 'islam',
            'excerpt' => 'Bibendum letius sed auctor netus montes posuere nulla potenti...',
            'bio_user' => 'Bibendum letius sed auctor netus montes posuere nulla potenti odio nascetur sem interdum placerat sapien eu egestas taciti gravida habitasse',
        ]);

        User::create([
            'name' => 'Moch Fachrizal Zakaria',
            'email' => 'fachrizalzakaria@gmail.com',
            'password' => bcrypt(''),
            'alamat' => 'Jl Purwodadi 27',
            'job' => 'Designer UI/UX',
            'phone_number' => '0831-9154-4197',
            'profile_image' => null,
            'roles_type' => 2, //Karyawan
            'u_prov_id' => 11,
            'u_kota_id' => 409,
            'birthday' => null,
            'religion' => 'islam',
            'excerpt' => 'Bibendum letius sed auctor netus montes posuere nulla potenti...',
            'bio_user' => 'Bibendum letius sed auctor netus montes posuere nulla potenti odio nascetur sem interdum placerat sapien eu egestas taciti gravida habitasse',
        ]);
    }
}
