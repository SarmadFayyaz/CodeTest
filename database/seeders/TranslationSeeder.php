<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all(); // Fetch all languages once
        $chunkSize = 10000;            // Number of records per chunk
        $totalRecords = 100000;        // Total number of translations to create

        foreach ($languages as $language) {
            $prefix = "key_prefix_" . $language->id; // Base prefix for keys
            for ($i = 0; $i < $totalRecords / ($chunkSize * $languages->count()); $i++) {
                $translations = Translation::factory()
                    ->count($chunkSize)
                    ->make()
                    ->map(function ($translation) use ($language, $prefix) {
                        $translation['language_id'] = $language->id;
                        $translation['key'] = $prefix . '_' . Str::random(10); // Ensure uniqueness
                        return $translation->toArray();
                    });

                Translation::insert($translations->toArray());
            }
        }
    }
}
