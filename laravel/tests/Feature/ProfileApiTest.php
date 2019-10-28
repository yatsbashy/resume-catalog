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
    ];

    /**
     * テストユーザ作成
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * プロフィールを取得する
     *
     * @return void
     */
    public function testShow()
    {
        // テストデータ作成
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create(['user_id' => $user->id]);

        // API 呼び出し
        $response = $this->getJson(route('profile.show', ['id' => $user->id]));

        // レスポンスを assert
        $response->assertStatus(200)
            ->assertJsonStructure(self::PROFILE_JSON_STRUCTURE)
            ->assertJson([
                'picture_filename' => $profile->picture_filename,
            ]);
    }
}
