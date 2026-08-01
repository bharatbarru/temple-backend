<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::find(1) == null){
            $user = User::create([
                'id'=>1,
                'name' => 'F9 Admin',
                'email' => 'admin@admin.com',
                'mobile' => '1234567890',
                'password' => '$2y$10$uJ/qjQ.R/EFB3F9kfoMx5uZOlwm4ErEfvnuK5fsLuV5syNXmcsNPC',
                'created_at'=>'2023-04-18 12:10:49',
                'updated_at'=>'2023-04-18 12:10:49',
            ]);
            $user->assignRole('Developer Admin');
        }
    }
}
