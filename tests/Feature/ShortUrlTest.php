<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a short URL', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/shorten', [
        'original_url' => 'https://example.com',
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('short_urls', [
        'original_url' => 'https://example.com',
        'user_id' => $user->id,
    ]);
});

it('will not create a short URL with invalid URL', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/shorten', [
        'original_url' => 'not-a-valid-url',
    ]);

    $response->assertSessionHasErrors('original_url');
});

it('can redirect to original URL', function () {
    $shortUrl = ShortUrl::factory()->create();

    $response = $this->get('/' . $shortUrl->short_url);

    $response->assertRedirect($shortUrl->original_url);
});

it('can increment click count', function () {
    $shortUrl = ShortUrl::factory()->create(['click_count' => 0]);

    $this->get('/' . $shortUrl->short_url);

    $this->assertEquals(1, $shortUrl->fresh()->click_count);
});

it('can show user\'s URLs in dashboard', function () {
    $user = User::factory()->create();
    $shortUrls = ShortUrl::factory()->count(3)->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
    $shortUrls->each(function ($url) use ($response) {
        $response->assertSee($url->short_url);
    });
});

it('can edit a short URL', function () {
    $user = User::factory()->create();
    $shortUrl = ShortUrl::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get('/url/edit/' . $shortUrl->id);

    $response->assertStatus(200);
    $response->assertSee($shortUrl->short_url);
});

it('can update a short URL', function () {
    $user = User::factory()->create();
    $shortUrl = ShortUrl::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->patch('/url/update/' . $shortUrl->id, [
        'id' => $shortUrl->id,
        'custom_short_code' => 'newcod',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertDatabaseHas('short_urls', [
        'id' => $shortUrl->id,
        'short_url' => 'newcod',
    ]);
});

it('can remove a short URL', function () {
    $user = User::factory()->create();
    $shortUrl = ShortUrl::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->delete('/url/remove/' . $shortUrl->id);

    $response->assertRedirect();
    $this->assertDatabaseMissing('short_urls', ['id' => $shortUrl->id]);
});

it('will not allow updating with existing short code', function () {
    $user = User::factory()->create();
    $shortUrl1 = ShortUrl::factory()->create(['user_id' => $user->id]);
    $shortUrl2 = ShortUrl::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->patch('/url/update/' . $shortUrl1->id, [
        'id' => $shortUrl1->id,
        'custom_short_code' => $shortUrl2->short_url,
    ]);

    $response->assertSessionHasErrors('custom_short_code');
});

it('can create a short URL with custom short code', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/shorten', [
        'original_url' => 'https://example.com',
        'custom_short_code' => 'custom123',
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('short_urls', [
        'original_url' => 'https://example.com',
        'short_url' => 'custom123',
        'user_id' => $user->id,
    ]);
});

it('returns an error if the custom short code already exists', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $shortUrl1 = ShortUrl::factory()->create(['short_url' => 'custom123', 'user_id' => $user->id]);

    $response = $this->post('/shorten', [
        'original_url' => 'https://example.com',
        'custom_short_code' => 'custom123',
    ]);

    $response->assertSessionHasErrors('custom_short_code');
});