<?php

namespace App\Http\Controllers\Tribe;

use App\Handlers\LogHandler;
use App\Handlers\FormHandler;
use App\Handlers\TribeHandler;
use App\Handlers\ServerHandler;
use App\Rules\ReceivingUserRule;
use App\Exceptions\TribeException;
use App\Http\Controllers\Controller;
use App\Models\Tribe\Tribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Ark\ArkOfficialServer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use App\Exceptions\TribeHandlerException;

class TribeController extends Controller
{
    /**
     * Displays the Tribe Create View
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create() {
        $user = Auth::user();
        $servers = ServerHandler::getOfficialServers();
        if($user->tribe != null) {
            Session::flash('warning', 'You have already created a tribe, consider editing it instead.');
            return redirect()->route('tribe.edit', $user->tribe->uuid);
        }

        return view('tribe.create')
                ->withServers($servers);
    }

    /**
     * Returns the Edit Tribe View or Redirects to Create Route
     *
     * @return \Illuminate\Http\RedirectResponse, void
     */
    public function edit($uuid) {
        $user = Auth::user();
        $tribe = Tribe::where('uuid', $uuid)->first();
        // If no tribe exists
        if(!$tribe) {
            Session::flash('warning', 'You have to create a tribe before editing it!');
            return redirect()->route('tribe.create');
        }
        // If the authenticated user is not the owner
        if(!$tribe->isUserTribeOwner) {
            Session::flash('danger', 'You can not edit this tribe because you are not the owner of the tribe.');
            return redirect()->route('user.dashboard');
        }

        return view('tribe.edit')
                    ->withTribe($tribe);
    }

    /**
     * Stores the tribe in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {

        $request = FormHandler::clean($request);
        $validator = TribeHandler::validateTribeRequest($request);
        if($validator->fails()) {
            return redirect()
                ->route('tribe.create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $tribe = TribeHandler::storeNewTribe($request);

        if(!$tribe) {
            Session::flash('danger', 'Something went wrong while trying to save the tribe. Please contact a staff member if this happens again.');
            return redirect()->route('tribe.create');
        }

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
    public function update(Request $request, $uuid) {
        $tribe = Tribe::where('uuid', $uuid)->firstOrFail();
        $request = FormHandler::clean($request);
        $validator = TribeHandler::validateTribeRequest($request);
        if($validator->fails()) {
            return redirect()
                ->route('tribe.edit', $tribe->uuid)
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $tribe = TribeHandler::updateTribe($request, $tribe);

        if(!$tribe) {
            Session::flash('danger', 'Something went wrong while trying to save the tribe. Please contact a staff member if this happens again.');
            return redirect()->route('tribe.create');
        }

        // Flash Session Message and Return
        Session::flash('success', 'You have successfully updated your tribe!');
        return redirect()->route('user.dashboard');

    }

    /**
     * Returns the add tribemate/user form view
     *
     * @param $uuid
     * @return mixed
     */
    public function addUser($uuid) {
        $tribe = Tribe::where('uuid', $uuid)->firstOrFail();
        if(!$tribe->isUserTribeOwner) {
            Session::flash('danger', 'You can not add a tribemate to this tribe because you are not the owner of the tribe.');
            return redirect()->route('user.dashboard');
        }
        return view('tribe.user.add')
                ->withTribe($tribe);
    }

    /**
     * Sends an invite to the supplied user via the form on the
     * last route, and then gives them a link to allow them to accept the invite.
     *
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendTribeInviteEmail(Request $request, $uuid) {
        $request = FormHandler::clean($request);
        $this->validate($request, [
            'receiving_user' => ['required', 'string', new ReceivingUserRule]
        ]);

        try {
            TribeHandler::sendUserInviteEmail($request, $uuid);
        } catch (TribeHandlerException $e) {
            return redirect()
                    ->route('tribe.user.add', $uuid)
                    ->withErrors(['message' => $e->getMessage()]);
        }

        Session::flash('success', 'An invite has been sent to the user! Tell them to check their email (and spam folders) and click on the link to accept the invite!');
        return redirect()->route('user.dashboard');
    }

    /**
     * Accepts the tribe invitation from link in email
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvite($token) {
        try {
            TribeHandler::acceptInvite($token);
        } catch (TribeHandlerException $e) {
            return redirect()
                    ->route('user.dashboard')
                    ->withErrors(['message' => $e->getMessage()]);
        }
        Session::flash('success', 'You have been added to the tribe!');
        return redirect()->route('user.dashboard');
    }


}
