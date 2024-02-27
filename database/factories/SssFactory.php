<?php

namespace Database\Factories;

use App\Models\Sss;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sss>
 */
class SssFactory extends Factory
{
    protected $model = Sss::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'answer' => $this->faker->text,
        ];
    }
}
