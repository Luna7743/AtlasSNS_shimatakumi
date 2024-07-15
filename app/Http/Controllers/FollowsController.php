<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // 追加

use Illuminate\Http\Request;
use App\User;
use App\Follow;


class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

}
