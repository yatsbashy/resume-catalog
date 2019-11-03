<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // テストデータ作成
        $this->user = factory(User::class)->create();
    }

    /**
     * 登録済みユーザを認証して返却する
     *
     * @return void
     */
    public function testLogin()
    {
        // API 呼び出し
        $response = $this->postJson(route('login'), [
            'email'    => $this->user->email,
            'password' => 'password',
        ]);

        // レスポンスを assert
        $response->assertStatus(200)
            ->assertJson(['name' => $this->user->name]);
        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * ユーザをログアウトさせる
     *
     * @return void
     */
    public function testLogout()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('logout'));

        $response->assertStatus(200);
        $this->assertGuest();
    }
}
