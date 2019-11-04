<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Work;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkApiTest extends TestCase
{
    use RefreshDatabase;

    const WORK_JSON_STRUCTURE = [
        'id',
        'user_id',
        'started_at',
        'ended_at',
        'title',
        'description',
        'role',
        'scale',
    ];

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // テストデータ作成
        $this->user = factory(User::class)->create();
        $this->work = factory(Work::class)->create(['user_id' => $this->user->id]);
    }

    /**
     * Work 一覧を返却する
     *
     * @return void
     */
    public function testIndex()
    {
        // API 呼び出し
        $response = $this->getJson(route('works.index', ['user' => $this->user->id]));

        // レスポンスを assert
        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => self::WORK_JSON_STRUCTURE,
            ]
        ]);
    }
}
