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
        User::create([
            'name'=> 'Ayyub2',
            'store_id',2,
            'email'=>'ay@app.com',
            'password'=>Hash::make(123456789),
            'type'=>'admin'
        ]);
    }
}
