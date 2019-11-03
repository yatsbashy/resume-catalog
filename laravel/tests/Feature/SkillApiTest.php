<?php

namespace Tests\Feature;

use App\Models\Skill;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SkillApiTest extends TestCase
{
    use RefreshDatabase;

    const SKILL_JSON_STRUCTURE = [
        'id',
        'user_id',
        'name',
        'months_experience',
        'comment',
    ];

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // テストデータ作成
        $this->user = factory(User::class)->create();
        $this->skill = factory(Skill::class)->create(['user_id' => $this->user->id]);
    }

    /**
     * Skill 一覧を返却する
     *
     * @return void
     */
    public function testIndex()
    {
        // API 呼び出し
        $response = $this->getJson(route('skills.index', ['user' => $this->user->id]));

        // レスポンスを assert
        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => self::SKILL_JSON_STRUCTURE,
            ]
        ]);
    }
}
