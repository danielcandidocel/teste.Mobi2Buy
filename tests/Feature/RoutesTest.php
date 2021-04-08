<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * @return void
     */
    public function testOnlyLoggedCanSeeUrlsList()
    {
        $response = $this->get('/home')->assertRedirect('/login');

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function testAccessedHomeRedirectToLogin()
    {
        $response = $this->get('/')->assertRedirect('/login');

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function testHomeRedirect()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/login');

        $response = $this->get('/home');

        $response->assertViewIs('home');
    }

    /**
     * @return void
     */
    public function testApiRedirectUrlShortened()
    {
        $shortened = Str::random(6);
        $this->providersNewUrlShortened($shortened);

        $response = $this->get('/api/u/'.$shortened);

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function testApiStoreNewUrlShortened()
    {
        $shortened = Str::random(6);
        $response = $this->providersNewUrlShortened($shortened);

        $response->assertStatus(201);
    }

    /**
     * @return void
     */
    public function testApiCanNotStoreNewUrlShortenedBecauseUrlExists()
    {
        $shortened = Str::random(6);
        $this->providersNewUrlShortened($shortened);

        $this->providersNewUrlShortened($shortened)->assertStatus(302);
    }

    /**
     * @return void
     */
    public function testApiCanNotStoreNewUrlShortenedBecauseUrlExpired()
    {
        $shortened = Str::random(6);
        $this->post('/api/url', [
            'url_complete'      => 'https://mobi2buy.com/',
            'shortened'         => $shortened,
            'expiration_date'   => now()->addDays(-7)
        ]);

        $response = $this->get('/api/u/'.$shortened);

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function testApiCanNotStoreNewUrlShortenedBecauseUrlNonexistent()
    {
        $response = $this->get('/api/u/ABC');

        $response->assertStatus(302);
    }

    /**
     * @param $shortened
     * @return TestResponse
     */
    public function providersNewUrlShortened($shortened): TestResponse
    {
        return $this->post('/api/url', [
            'url_complete'      => 'https://mobi2buy.com/',
            'shortened'         => $shortened,
            'expiration_date'   => now()->addDays(7)
        ]);
    }
}
