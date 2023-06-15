<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Admin Dashboard',
            'email'     => 'app@app.com',
            'password'  => bcrypt('sasa'),
            'is_admin' => 1,
            'image'     => 'u1.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
