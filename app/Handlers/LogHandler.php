<?php

namespace App\Handlers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use App\Exceptions\Logging\LogException;

class LogHandler {
    /**
     * Valid Event Types
     */
    const types =['login', 'logout', 'store', 'update', 'cli', 'error', 'generic'];

    /**
     * Define the classes static variables
     *
     * @var string
     */
    private static $type, $message, $location;
    /**
     * @var \App\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    private static $user;


    public static function event(string $type, string $location, string $message = "") {
        try {
            self::checkIfTypeIsValid($type);
            self::assignToVariables($type, $location, $message);

            switch($type) {
                case 'login':
                case 'logout':
                    self::addAuthenticationEvent();
                    break;
                case 'store':
                case 'update':
                    self::addControllerEvent();
                    break;
                case 'cli':
                    self::addCliEvent();
                    break;
                case 'error':
                    self::addErrorEvent();
                    break;
                case 'generic':
                    self::addGenericEvent();
                    break;
            }

        } catch (LogException $e) {
            self::addErrorEvent($e->getMessage());
        }
    }

    private static function checkIfTypeIsValid(string $type) {
        if(!in_array($type, self::types)) {
            throw new LogException("Log type of '{$type}' is not a valid type for LogHandler@event");
        }
    }

    private static function assignToVariables(string $type, string $location, string $message) {
        self::$type = $type;
        self::$location = $location;
        self::$message = $message;
        if(Auth::check()) {
            self::$user = Auth::user();
        }
    }

    private static function addAuthenticationEvent()
    {
        $log = new Log;
        $log->type = self::$type;
        $log->payload = self::getAuthenticationEventPayload();
        self::saveLog($log);
    }

    private static function addControllerEvent()
    {
        $log = new Log;
        $log->type = self::$type;
        $log->payload = self::getControllerEventPayload();
        self::saveLog($log);
    }

    private static function addCliEvent()
    {
        $log = new Log;
        $log->type = 'cli';
        $log->isCli = true;
        try {
            $log->payload = self::getEventPayload();
        } catch (LogException $e) {
            dd($e->getMessage());
        }
        self::saveLog($log);
    }

    private static function addErrorEvent(string $message = null) {
        $log = new Log;
        $log->payload = self::$message;
        $log->type = 'error';
        $log->isError = true;
        if($message != null) {
            $log->payload = $message;
        }
        self::saveLog($log);
    }

    private static function addGenericEvent()
    {
        $log = new Log;
        $log->type = self::$type;
        try {
            $log->payload = self::getEventPayload();
        } catch (LogException $e) {
            dd($e->getMessage());
        }
        self::saveLog($log);
    }

    private static function saveLog(Log $log) {
        $log->user_id = self::getUserID();
        try {
            $log->save();
        } catch (QueryException $e) {
            Session::flash('danger', 'Contact an admin, and let them know that an error occurred! Err Code: LogError@Query');
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    private static function getAuthenticationEventPayload() {
        if(self::$type == 'login') {
            return "User [id: " . self::$user->id . ", username: " . self::$user->username . "] has logged in.";
        }
        return "User [id: " . self::$user->id . ", username: " . self::$user->username . "] has logged out.";
    }

    private static function getControllerEventPayload()
    {
        if(self::$type == 'store') {
            return "STORE method was called on controller " . self::$location . ".";
        }
        return "UPDATE method was called on controller " . self::$location . ".";
    }

    private static function getEventPayload()
    {
        if(self::$message == "") {
            throw new LogException('Message variable can not be an empty string.');
        }
        return self::$message;
    }

    private static function getUserID()
    {
        if(self::$user != null) {
            return self::$user->id;
        }
        return null;
    }


}