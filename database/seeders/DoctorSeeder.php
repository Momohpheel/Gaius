<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = "Admin Doctor";
        $user->matric_number = "";
        $user->email = "admin@mcuclinic.com";
        $user->password = Hash::make("password");
        $user->role = 'doctor';
        $user->save();

        //dfddfdffjj
    }
}
