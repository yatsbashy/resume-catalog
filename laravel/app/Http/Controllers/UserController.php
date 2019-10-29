<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ユーザ一覧を返却する
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('profile')->paginate(20);

        return UserResource::collection($users);
    }

    /**
     * ユーザ詳細を返却する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        
        return new UserResource($user);
    }
}
