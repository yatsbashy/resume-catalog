<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // create a test user
        $this->user = factory(User::class)->create();
    }

    /**
     * ログイン中のユーザを確認する
     *
     * @return void
     */
    public function testIsLoggedIn()
    {
        $response = $this->actingAs($this->user)
            ->getJson(route('user'));

        $response->assertStatus(200)
            ->assertJson(['name' => $this->user->name]);
    }

    /**
     * ユーザがログインしていない場合空文字を返却する
     *
     * @return void
     */
    public function testIsNotLoggedIn()
    {
        $response = $this->getJson(route('user'));

        $response->assertStatus(200);
        $this->assertEquals('', $response->content());
    }
}
