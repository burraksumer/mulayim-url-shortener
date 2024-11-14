<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShortUrl;
use App\Models\User;

class ShortUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {
            ShortUrl::factory()->count(5)->forUser($user)->create();
        });

        ShortUrl::factory()->count(10)->create();

    }
}
