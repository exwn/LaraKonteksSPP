<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Si Paling Kepala Sekolah',
            'email' => 'kepsek@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $super_admin->assignRole('super_admin');

        $admin = User::create([
            'name' => 'Si Paling Tata Usaha',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Si Paling Siswa',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');
    }
}
