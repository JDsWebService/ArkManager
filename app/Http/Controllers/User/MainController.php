<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Handlers\FormHandler;
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
        $user = Auth::user();
        $this->validate($request, [
            'news_notifications' => 'required|in:on,off',
            'discord_notifications' => 'required|in:on,off',
            'internal_notifications' => 'required|in:on,off',
            'twitter' => 'nullable|string',
            'facebook' => 'nullable|url',
            'email' => 'required|email'
        ]);
        $request = FormHandler::clean($request);
        $user->twitter = $request->twitter;
        $user->facebook = $request->facebook;
        $user->email = $request->email;
        $user->news_notifications = ($request->news_notifications == 'on' ? true : false);
        $user->discord_notifications = ($request->discord_notifications == 'on' ? true : false);
        $user->internal_notifications = ($request->internal_notifications == 'on' ? true : false);
        $user->save();
        Session::flash('success', 'You have saved your settings successfully!');
        return redirect()->route('user.dashboard');
    }
}
