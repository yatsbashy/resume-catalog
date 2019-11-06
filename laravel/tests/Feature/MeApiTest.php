<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // テストデータを作成
        $this->user = factory(User::class)->create();
    }

    /**
     * ログイン中のユーザを返却する
     *
     * @return void
     */
    public function testIsLoggedIn()
    {
        $response = $this->actingAs($this->user)
            ->getJson(route('me'));

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
        $response = $this->getJson(route('me'));

        $response->assertStatus(200);
        $this->assertEquals('', $response->content());
    }
}
