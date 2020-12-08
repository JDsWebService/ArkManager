<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    /**
     * Testing Route for Admin Backend
     */
    public function test() {
        return view('admin.sandbox');
    }
}
