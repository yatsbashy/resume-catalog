<?php

namespace Tests\Feature;

use App\Http\Controllers\Auth\RegisterController;
use PHPUnit\Framework\AssertionFailedError;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    private const REGISTERED_USER = [
        'name',
        'email'
    ];

    /**
     * 新規登録したユーザを返却する
     *
     * @return void
     */
    public function testResister()
    {
        $data = [
            'name'                  => 'testuser',
            'email'                 => 'test@email.com',
            'password'              => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        // API 呼び出し
        $response = $this->postJson(route('register'), $data);

        // レスポンスを assert
        $response->assertStatus(201)
            ->assertJsonStructure(self::REGISTERED_USER)
            ->assertJson(['name' => $data['name']]);
        // データ型をチェック
        collect($response->json('data'))->each(function ($item) {
            return $this->assertDataTypes($item);
        });
        // Profile が作成されているか assert
        $user_json = $response->json();
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user_json['id']
        ]);
    }

    /**
     * データ型をチェックする
     *
     * @param array $item
     * @return bool
     */
    private function assertDataTypes($item)
    {
        try {
            $this->assertIsString($item['name']);
            $this->assertIsString($item['email']);
            $this->assertIsString($item['password']);
        } catch (AssertionFailedError $error) {
            echo "AssertionFailedError Occurred:\n" . json_encode($item, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
            throw $error;
        }
        return true;
    }
}
