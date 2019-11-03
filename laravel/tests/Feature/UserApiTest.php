<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    const USER_JSON_STRUCTURE = [
            'id',
            'name',
            'profile_picture_url',
    ];

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
        $this->user->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
    }

    /**
     * ユーザ一覧を返却する
     *
     * @return void
     */
    public function testIndex()
    {
        // テストデータを作成
        $user = factory(User::class)->create();
        factory(Profile::class)->create(['user_id' => $user->id]);

        // API 呼び出し
        $response = $this->getJson(route('users.index'));

        // レスポンスを assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => self::USER_JSON_STRUCTURE,
                ]
            ]);
    }

    /**
     * ユーザ詳細を返却する
     *
     * @return void
     */
    public function testShow()
    {
        $user = factory(User::class)->create();
        factory(Profile::class)->create(['user_id' => $user->id]);

        $response = $this->getJson(route('users.show', ['id' => $user->id]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => self::USER_JSON_STRUCTURE,
            ])
            ->assertJson([
                'data' => [
                    'name' => $user->name,
                ]
            ]);
    }
}
