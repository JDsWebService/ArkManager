<?php

namespace App\Http\Controllers\Tribe;

use App\Handlers\FormHandler;
use App\Handlers\TribeHandler;
use App\Http\Controllers\Controller;
use App\Models\Tribe\Application;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    /**
     * Returns the tribe application create view
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('tribe.applications.create');
    }

    /**
     * Stores the tribe application in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        FormHandler::clean($request);
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:20000|min:150'
        ]);

        $application = new Application();
        $application->title = $request->title;
        $application->description = $request->description;
        $application->tribe_id = TribeHandler::getTribeID();
        $application->user_id = Auth::user()->id;
        $application->uuid = Str::uuid()->toString();
        $application->home_server_id = TribeHandler::getTribeHomeServerID();

        $application->save();
        Session::flash('success', "You have saved your tribes application successfully!");
        return redirect()->route('user.dashboard');
    }

    /**
     * Returns the tribe application edit view
     *
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($uuid) {
        $application = Application::where('uuid', $uuid)->first();
        if($application->tribe_id != TribeHandler::getTribeID() || $application->user_id != Auth::user()->id) {
            Session::flash('danger', 'You may not edit another tribes application.');
            return redirect()->route('user.dashboard');
        }
        return view('tribe.applications.edit')
                ->withApplication($application);
    }

    /**
     * Updates a Tribes Application in the database
     *
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $uuid) {
        FormHandler::clean($request);
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:20000|min:150'
        ]);

        $application = Application::where('uuid', $uuid)->first();

        if($application->tribe_id != TribeHandler::getTribeID() || $application->user_id != Auth::user()->id) {
            Session::flash('danger', 'You may not edit another tribes application.');
            return redirect()->route('user.dashboard');
        }

        $application->title = $request->title;
        $application->description = $request->description;
        $application->tribe_id = TribeHandler::getTribeID();
        $application->user_id = Auth::user()->id;
        $application->home_server_id = TribeHandler::getTribeHomeServerID();

        $application->save();
        Session::flash('success', "You have saved your tribes application successfully!");
        return redirect()->route('user.dashboard');
    }
}
