<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => 'Samuel Gerges',
            'contact_email' => 'samuel@app.com',
            'address' => 'Cairo',
        ]);
    }
}
