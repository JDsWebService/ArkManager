<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dino\UserDinoColor;

class TestingController extends Controller
{
    /**
     * Testing Route for Admin Backend
     */
    public function test() {
        $dino = UserDinoColor::find(1)->first();
        print "Color Zero: {$dino->colorZero->name}<br>";
        print "Color One: {$dino->colorOne->name}<br>";
        print "Color Two: {$dino->colorTwo->name}<br>";
        print "Color Three: {$dino->colorThree->name}<br>";
        print "Color Four: {$dino->colorFour->name}<br>";
        print "Color Five: {$dino->colorFive->name}<br>";
    }
}
