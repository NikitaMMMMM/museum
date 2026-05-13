<?php

namespace Database\Factories;

use App\Models\Exhibit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Exhibit>
 */
class ExhibitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Exhibit::class;
    public function definition(): array
    {

        $title = fake()->unique()->words(3, true);
        $year = fake()->numberBetween(1000, 2023);

        return [
            'inventory_number' => fake()->unique()->bothify('INV-####-##'),
            'title' => $title,
            'slug' => $this->generateUniqueSlug($title),
            'short_description' => fake()->sentence(15),
            'description' => implode(" ", fake()->paragraphs(3)),
            'year_created' => $year,
            'condition' => fake()->randomElement([
                'Отличное',
                'Хорошее',
                'Удовлетворительное',
                'Плохое',
                'Требует реставрации'
            ]),
            'donor_name' => fake()->optional(0.7)->name(),
            'user_id' => User::factory(),
            'is_published' => fake()->boolean(80),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    private function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Exhibit::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
