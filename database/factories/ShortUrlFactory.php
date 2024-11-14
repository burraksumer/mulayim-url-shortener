<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ShortUrl;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShortUrl>
 */
class ShortUrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ShortUrl::class;
    public function definition(): array
    {
        return [
            'user_id' => null,
            'original_url' => $this->faker->url(),
            'short_url' => Str::random(6),
            'click_count' => $this->faker->numberBetween(0, 1000),
        ];
    }

    public function forUser(User $user): self
    {
        return $this->state(function (array $attributes) use ($user) {
            return ['user_id' => $user->id];
        });
    }
}
