<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * ユーザのプロフィール詳細
     *
     * @param  string  $user_id
     * @return Profile
     */
    public function show(string $user_id)
    {
        return Profile::where('user_id', $user_id)->first();
    }
}
