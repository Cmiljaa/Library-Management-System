<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'loan_duration', 'value' => 28, 'type' => 'integer'],
            ['key' => 'max_books', 'value' => 3, 'type' => 'integer'],
            ['key' => 'overdue_fee', 'value' => 0.5, 'type' => 'decimal']
         ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
