<?php

namespace App\Http\Controllers\User;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Handlers\FormHandler;
use App\Handlers\DinoHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('user.dashboard');
    }

    /**
     * Returns the edit account settings view to the user
     *
     * @return mixed
     */
    public function settings() {
        $user = Auth::user();
        return view('user.settings')
                ->withUser($user);
    }

    /**
     * Stores the account settings in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeSettings(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        $this->validate($request, [
            'news_notifications' => 'required|in:1,0',
            'discord_notifications' => 'nullable|in:1,0',
            'internal_notifications' => 'nullable|in:1,0',
            'twitter' => 'nullable|string',
            'facebook' => 'nullable|url',
            'email' => 'required|email',
            'tribe_sees_dinos' => 'nullable|in:1,0',
        ]);
        $request = FormHandler::clean($request);
        $user->twitter = $request->twitter;
        $user->facebook = $request->facebook;
        $user->email = $request->email;
        $user->news_notifications = ($request->news_notifications == '1' ? true : false);
        $user->discord_notifications = ($request->discord_notifications == '1' ? true : false);
        $user->internal_notifications = ($request->internal_notifications == '1' ? true : false);
        $user->tribe_sees_dinos = ($request->tribe_sees_dinos == '1' ? true : false);
        DinoHandler::updateUserDinosTribeSettings($user);
        $user->save();
        Session::flash('success', 'You have saved your settings successfully!');
        return redirect()->route('user.dashboard');
    }
}
