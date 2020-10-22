<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
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
        return redirect()->route('comingsoon');
        // return view('index');
    }

    public function comingsoon() {
        return view('pages.comingsoon');
    }

    public function subscribe(Request $request) {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $email = Purifier::clean($request->email);
        $subscription = new Subscription;
        $subscription->email = $email;

        try {
            $subscription->save();
            Session::flash('success', 'You have successfully been put on our email list!');
        }catch(QueryException $e) {
            if($e->errorInfo[1] == 1062) {
                Session::flash('danger', "Seems like you've already been subscribed!");
            }
        }

        return redirect()->route('comingsoon');
    }
}
