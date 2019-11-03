<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileApiTest extends TestCase
{
    use RefreshDatabase;

    const PROFILE_JSON_STRUCTURE = [
        'id',
        'user_id',
        'picture_filename',
        'final_education',
        'github_url',
        'qiita_url',
        'specialty',
        'created_at',
        'updated_at',
    ];

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // テストデータ作成
        $this->user = factory(User::class)->create();
        $this->user->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
    }

    /**
     * プロフィールを取得する
     *
     * @return void
     */
    public function testShow()
    {
        // API 呼び出し
        $response = $this->getJson(route('profile.show', ['id' => $this->user->id]));

        // レスポンスを assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => self::PROFILE_JSON_STRUCTURE
            ])
            ->assertJson([
                'data' => [
                    'picture_filename' => $this->user->profile->picture_filename,
                ]
            ]);
    }
}
