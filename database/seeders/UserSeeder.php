<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Samuel Gerges',
            'email' => 'admin@app.com',
            'password' => bcrypt('sasa'),
            'image' => 'u1.png'
        ]);
    }
}
