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
Route::get('/user', function () {
    return Auth::user();
})->name('user');

// プロフィール
Route::get('/users/{id}/profile', 'ProfileController@show')->name('profile.show');
