<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * ユーザのプロフィール詳細
     *
     * @param  int  $user_id
     * @return ProfileResource
     */
    public function show(int $user_id)
    {
        $profile = Profile::where('user_id', $user_id)->first();

        return new ProfileResource($profile);
    }
}
