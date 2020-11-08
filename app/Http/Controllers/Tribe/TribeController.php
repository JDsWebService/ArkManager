<?php

namespace App\Http\Controllers\Tribe;

use App\Http\Controllers\Controller;
use App\Models\Tribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class TribeController extends Controller
{
    /**
     * Displays the Tribe Create View
     *
     * @return void
     */
    public function create() {
        $user = Auth::user();

        if($user->tribe != null) {
            Session::flash('warning', 'You have already created a tribe, consider editing it instead.');
            return redirect()->route('tribe.edit');
        }

        return view('tribe.create');
    }

    /**
     * Returns the Eidt Tribe View or Redirects to Create Route
     *
     * @return \Illuminate\Http\RedirectResponse, void
     */
    public function edit($slug) {
        $user = Auth::user();
        $tribe = Tribe::where('slug', $user->tribe->slug)->first();

        if(!$tribe) {
            Session::flash('warning', 'You have to create a tribe before editing it!');
            return redirect()->route('tribe.create');
        }

        return view('tribe.edit')->withTribe($tribe);
    }

    /**
     * Stores the tribe in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
            'founded_on' => 'required|date'
        ]);

        // Handle the Tribe Information from the Request
        $tribe = $this->handleTribeInfo($request);

        // Flash Session Message and Return
        Session::flash('success', 'You have successfully created your tribe!');

        return redirect()->route('user.dashboard');
    }

    /**
     * Updates the Tribe Information in the Database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
            'founded_on' => 'required|date'
        ]);

        $tribe = $this->handleTribeInfo($request);

        // Flash Session Message and Return
        Session::flash('success', 'You have successfully saved your tribe!');

        return redirect()->route('user.dashboard');

    }

    /**
     * Handles the Tribe Information inside the Database
     *
     * @param Request $request
     */
    private function handleTribeInfo(Request $request) {
        $user = Auth::user();

        if(Route::currentRouteName() == 'tribe.store') {
            $tribe = new Tribe;
        } else {
            $tribe = Tribe::where('slug', $user->tribe->slug)->first();
        }

        // Purify some values
        $name = Purifier::clean($request->name);

        $tribe->name = $name;
        $tribe->founded_on = $request->founded_on;
        $tribe->user_id = $user->id;
        $tribe->slug = Str::slug($name . '-' . $user->provider_id);

        // Save The Tribe
        $tribe->save();
    }


}
