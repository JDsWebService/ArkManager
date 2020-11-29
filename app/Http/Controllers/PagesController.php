<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mews\Purifier\Facades\Purifier;

class PagesController extends Controller
{
    /**
     * Returns the websites index
     *
     * @return \Illuminate\View\View
     */
    public function index() {
         // return redirect()->route('comingsoon');
         return view('index');
    }

    /**
     * Returns the websites Privacy Policy Page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy() {
        return view('pages.privacy');
    }

    /**
     * Returns the websites Terms of Service Page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function termsOfService() {
        return view('pages.terms');
    }

    public function acceptConditions() {
        return view('pages.acceptConditions');
    }

    public function acceptConditionsStore(Request $request) {
        $user = Auth::user();
        if($request->accept == true) {
            $user->tos_accept = true;
            $user->privacy_accept = true;
            $user->tos_accept_date = Carbon::now();
            $user->privacy_accept_date = Carbon::now();
            $user->save();
            Session::flash('success', 'You have accepted our Terms & Conditions, enjoy your stay!');
            return redirect()->route('user.dashboard');
        }

        Session::flash('warning', 'You need to accept our Terms & Conditions');
        return redirect()->back();
    }
}
