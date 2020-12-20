<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Returns the index view of the users to the admin
     *
     * @return mixed
     */
    public function index() {
        $users = User::orderBy('username')->paginate();
        return view('admin.users.index')
                    ->withUsers($users);
    }

    public function view($id) {
        $user = User::where('id', $id)->first();
        if($user == null) {
            Session::flash('warning', "Can not find the user with the ID of: {$id}");
            return redirect()->route('admin.users.index');
        }
        return view('admin.users.view')
                    ->withUser($user);
    }
}
