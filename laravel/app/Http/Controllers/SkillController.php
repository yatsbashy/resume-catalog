<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * ユーザの skills 一覧
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $user_id)
    {
        $skills = Skill::where('user_id', $user_id)->get();

        return SkillResource::collection($skills);
    }
}
