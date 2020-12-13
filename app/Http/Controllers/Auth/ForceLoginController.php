<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\User;
use App\Handlers\FormHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ForceLoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Shows the Force Login Form to the admin user
     *
     * @return \Illuminate\View\View
     */
    public function forceLoginForm() {
        return view('admin.auth.forceLogin');
    }

    public function forceLogin(Request $request) {
        FormHandler::clean($request);
        $user = User::where('email', $request->email)->first();
        if($user == null) {
            Session::flash('danger', 'This user does not exist');
            return redirect()->route('admin.force.login.form');
        }
        Auth::logout();
        Session::flush();
        Auth::login($user, true);
        return redirect()->route('user.dashboard');
    }

    /**
     * Logs out the user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('index');
    }
}
