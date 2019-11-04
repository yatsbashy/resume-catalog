<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkResource;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * ユーザの works 一覧
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $user_id)
    {
        $works = Work::where('user_id', $user_id)->get();

        return WorkResource::collection($works);
    }
}
