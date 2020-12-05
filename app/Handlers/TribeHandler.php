<?php


namespace App\Handlers;

use App\Models\Auth\User;
use App\Models\Tribe\Tribe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tribe\Invite;
use App\Models\Dino\UserDino;
use App\Exceptions\TribeException;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserAddedToTribe;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\TribeHandlerException;
use Illuminate\Contracts\Auth\Authenticatable;

class TribeHandler
{
    /**
     * Returns the tribe ID of the user
     *
     * @return mixed
     */
    public static function getTribeID() {
        return Auth::user()->tribe->id;
    }

    /**
     * Stores a new tribe in the database
     *
     * @param Request $request
     * @return bool
     */
    public static function storeNewTribe(Request $request)
    {
        $tribe = new Tribe;
        $tribe = self::handleTribeRequestFields($request, $tribe);

        return $tribe;
    }

    /**
     * Updates a tribe in the database
     *
     * @param Request $request
     * @param $tribe
     * @return bool
     */
    public static function updateTribe(Request $request, $tribe)
    {
        $user = Auth::user();
        if($user->id != $tribe->user_id) {
            return false;
        }
        $tribe = self::handleTribeRequestFields($request, $tribe);
        return $tribe;
    }

    /**
     * Validates the tribe request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validateTribeRequest(Request $request)
    {
        $validator = Validator::make($request->all(),
            self::getTribeValidationRules());
        $validator->setAttributeNames(self::getValidationAttributeNames());
        return $validator;
    }

    /**
     * Returns the tribe validation rules
     *
     * @return string[]
     */
    private static function getTribeValidationRules()
    {
        return [
            'name' => 'required|string',
            'founded_on' => 'required|date'
        ];
    }

    /**
     * Returns the Validation Attribute Names for the validator(s)
     *
     * @return string[]
     */
    private static function getValidationAttributeNames()
    {
        return [
            'name' => 'Tribe Name',
            'founded_on' => 'Tribe Founded On',
        ];
    }

    /**
     * Handles the tribe request fields
     *
     * @param Request $request
     * @param Tribe $tribe
     * @return bool
     */
    private static function handleTribeRequestFields(Request $request, Tribe $tribe)
    {
        // Grab the user
        $user = Auth::user();
        // Handle the tribe instance assignments form the request
        $tribe->name = $request->name;
        $tribe->founded_on = $request->founded_on;
        $tribe->user_id = $user->id;
        // Handle the UUID
        if($tribe->uuid == null) {
            $tribe->uuid = Str::uuid()->toString();
        }
        // Save The Tribe
        $tribeSave = $tribe->save();
        // Handle the User
        $user->tribe_id = $tribe->id;
        $userSave = $user->save();
        if($userSave && $tribeSave) {
            return true;
        }
        return false;
    }

    /**
     * Gets a user from the database based on the receiving_user request field
     *
     * @param Request $request
     * @return User
     */
    private static function getUserToAddToTribe(Request $request)
    {
        $receivingUser = User::where('fullusername', $request->receiving_user)->first();
        if($receivingUser == null) {
            $receivingUser = User::where('email', $request->receiving_user)->first();
        }
        return $receivingUser;
    }

    /**
     * Sends the user an invite email that invites them into the tribe of the sending user.
     *
     * @param Request $request
     * @param $uuid
     * @return bool
     * @throws TribeHandlerException
     */
    public static function sendUserInviteEmail(Request $request, $uuid)
    {
        // Receiving User Logic
        $receivingUser = self::getUserToAddToTribe($request);
        if($receivingUser == null) {
            throw new TribeHandlerException("Can not find the user in our records. Ensure that you typed the Discord Username or Discord eMail address correctly and try again!");
        }
        // Sending User Logic
        $sendingUser = Auth::user();
        if($sendingUser->id == $receivingUser->id) {
            throw new TribeHandlerException("You can't invite yourself to your own tribe. Nice try though! ;)");
        }
        $tribe = Tribe::where('uuid', $uuid)->firstOrFail();
        if($tribe->isUserTribeOwner) {
            $invite = self::saveInviteToDatabase($tribe, $receivingUser, $sendingUser);
            if($invite) {
                $receivingUser->notify(new UserAddedToTribe($sendingUser, $tribe, $invite->token));
                return true;
            }
        } else {
            throw new TribeHandlerException("You are not the tribe owner, so we can not allow you to add a user to the tribe.");
        }
        throw new TribeHandlerException("Something went wrong while trying to send the user an invite. Please contact the staff team via Discord to have them see whats going on.");
    }

    /**
     * Saves the Tribe Invite into the database for later reference.
     *
     * @param $tribe
     * @param User $receivingUser
     * @param Authenticatable $sendingUser
     * @return Invite
     */
    private static function saveInviteToDatabase($tribe, User $receivingUser, Authenticatable $sendingUser)
    {
        $invite = Invite::where('sent_to_user_id', $receivingUser->id)->first();
        if(!$invite) {
            $invite = new Invite;
        }
        $invite->token = Str::uuid()->toString();
        $invite->tribe_id = $tribe->id;
        $invite->sent_to_user_id = $receivingUser->id;
        $invite->sent_from_user_id = $sendingUser->id;
        $invite->sent_successfully = true;
        $invite->save();
        return $invite;
    }

    /**
     * Accepts the tribe invitation from the link sent via email
     *
     * @param $token
     * @return bool
     * @throws TribeHandlerException
     */
    public static function acceptInvite($token)
    {
        $user = Auth::user();
        $invite = Invite::where('token', $token)->firstOrFail();
        if(!$invite) {
            throw new TribeHandlerException("Can not find your invite. Try the link again. If it still doesn't work, send the staff team a message on our Discord and we'll try and help you out as best we can!");
        }
        if($user->id != $invite->sent_to_user_id) {
            throw new TribeHandlerException("You are not the recipient of this tribe invite. Please try again!");
        }
        $user->tribe_id = $invite->tribe_id;
        $user->save();

        self::updateUserDinosAfterInviteAccept($user);

        return true;
    }

    /**
     * Transfers all user dinos pre-invite to the new tribe
     *
     * @param $user
     * @return bool
     */
    private static function updateUserDinosAfterInviteAccept($user)
    {
        $dinos = UserDino::where('user_id', $user->id)->get();
        if($dinos->count() != 0) {
            foreach($dinos as $dino) {
                $dino->user_tribe_id = $user->tribe_id;
                $dino->save();
            }
        }
        return true;
    }

}
