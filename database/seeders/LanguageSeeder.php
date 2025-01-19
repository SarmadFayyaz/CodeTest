<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([
            'name' => 'English',
            'code' => 'en',
        ]);
        Language::create([
            'name' => 'Spanish',
            'code' => 'es',
        ]);
        Language::create([
            'name' => 'French',
            'code' => 'fr',
        ]);
        Language::create([
            'name' => 'German',
            'code' => 'de',
        ]);
        Language::create([
            'name' => 'Italian',
            'code' => 'it',
        ]);
    }
}
