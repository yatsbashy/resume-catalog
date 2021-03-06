<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 新規登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// ログイン/ログアウト
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// ログインユーザ
Route::get('/me', function () {
    return Auth::user();
})->name('me');

// ユーザ
Route::apiResource('/users', 'UserController')->only(['index', 'show']);

// プロフィール
Route::get('/users/{user}/profile', 'ProfileController@show')->name('profiles.show');

// Skill
Route::apiResource('/users/{user}/skills', 'SkillController')->only(['index']);

// Work
Route::apiResource('/users/{user}/works', 'WorkController')->only(['index']);
