<?php

use Tests\TestCase;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a short URL', function () {
    $shortUrl = ShortUrl::factory()->create();

    $this->assertDatabaseHas('short_urls', [
        'id' => $shortUrl->id,
    ]);
    $this->assertInstanceOf(ShortUrl::class, $shortUrl);
});

it('has short url as a fillable attribute', function () {
    $shortUrl = new ShortUrl();

    $fillable = ['original_url', 'short_url', 'user_id'];
    $this->assertEquals($fillable, $shortUrl->getFillable());
});

it('belongs to a user', function () {
    $user = User::factory()->create();
    $shortUrl = ShortUrl::factory()->create(['user_id' => $user->id]);

    $this->assertInstanceOf(User::class, $shortUrl->user);
    $this->assertEquals($user->id, $shortUrl->user->id);
}); 
