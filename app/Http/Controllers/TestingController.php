<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\UserHandler;
use App\Models\Dino\UserDinoColor;
use Illuminate\Support\Facades\Auth;

class TestingController extends Controller
{
    /**
     * Testing Route for Admin Backend
     */
    public function test() {
        $avatar = UserHandler::getUserAvatar(Auth::user());
        dd($avatar);
    }
}
