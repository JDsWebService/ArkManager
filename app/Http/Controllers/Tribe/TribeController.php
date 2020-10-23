<?php

namespace App\Http\Controllers\Tribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TribeController extends Controller
{

    public function create() {
        return view('tribe.create');
    }


}
