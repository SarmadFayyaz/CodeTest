<?php

namespace Database\Factories;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Predefined list of tags
        $tags = ['mobile', 'web', 'desktop', 'android', 'ios'];

        return [
            'language_id' => null,  // Placeholder, will be dynamically replaced
            'key' => null,         // Placeholder, will be dynamically replaced
            'content' => $this->faker->text(200), // Random content for the translation
            'tag' => $this->faker->randomElement($tags), // Randomly select a tag from the predefined list
        ];
    }

    /**
     * Assign language and ensure unique keys for the language.
     */
    public function withLanguage(int $languageId, string $keyPrefix): self
    {
        return $this->state(function () use ($languageId, $keyPrefix) {
            return [
                'language_id' => $languageId,
                'key' => Str::slug($keyPrefix, '_') . '_' . $languageId,
            ];
        });
    }
}
