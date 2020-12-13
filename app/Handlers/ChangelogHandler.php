<?php

namespace App\Handlers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Logs\Changelog;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ChangelogHandlerException;

class ChangelogHandler
{
    /**
     * Returns all the categories available for the changelog
     *
     * @return string[]
     */
    public static function getCategories() {
        return [
            'tribe' => 'Tribes',
            'dino' => 'Dino Mutations',
            'trade' => 'Trade Hub',
            'servers' => 'Ark Servers',
            'items' => 'Ark Items',
            'users' => 'Users',
            'colors' => 'Ark Dino Colors',
            'api' => 'ArkManager.app API',
            'misc' => 'Miscellaneous',
            'admin' => 'Admin Backend',
            'documentation' => 'Documentation',
        ];
    }

    /**
     * Saves the changelog entry into the database
     *
     * @param Request $request
     * @throws ChangelogHandlerException
     */
    public static function saveEntryToDatabase(Request $request)
    {
        $changelog = new Changelog;
        $changelog = self::handleChangelogRequestFields($request, $changelog);
        if(!$changelog->save()) {
            throw new ChangelogHandlerException("Error when saving the changelog occurred");
        }
    }

    /**
     * Validates the changelog request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validateChangelogRequest(Request $request)
    {
        $validator = Validator::make($request->all(),
            self::getChangelogValidationRules());
        $validator->setAttributeNames(self::getValidationAttributeNames());
        return $validator;
    }

    /**
     * Returns all the versioning information in array form
     *
     * @param Request $request
     * @param Changelog $changelog
     * @return array
     */
    private static function getVersion(Request $request)
    {
        $version = [];

        $majorVersion = self::getMajorVersion();
        $minorVersion = self::getMinorVersion();
        $patchVersion = self::getPatchVersion();
        switch($request->version_type) {
            case "major":
                $majorVersion++;
                $minorVersion = 0;
                $patchVersion = 0;
                break;
            case "minor":
                $minorVersion++;
                $patchVersion = 0;
                break;
            case "patch":
                $patchVersion++;
                break;
        }
        $version['major_version'] = $majorVersion;
        $version['minor_version'] = $minorVersion;
        $version['patch_version'] = $patchVersion;
        $version['prerelease'] = self::getPreReleaseStatus($request);
        $version['days_since_init'] = self::getDaysSinceInit();
        $version['full_version_string'] = $version['major_version'] . '.';
        $version['full_version_string'] .= $version['minor_version'] . '.';
        $version['full_version_string'] .= $version['patch_version'];
        $version['full_version_string'] .= ($version['prerelease']) ? '.b' : '';
        $version['full_version_string'] .= '-' . $version['days_since_init'];
        return $version;
    }

    /**
     * Gets the last major version number
     *
     * @return int
     */
    private static function getMajorVersion()
    {
        $lastEntry = Changelog::all()->last();
        if(!$lastEntry) {
            return 0;
        }
        return $lastEntry->major_version;
    }

    /**
     * Gets the last minor version number
     *
     * @return int
     */
    private static function getMinorVersion()
    {
        $lastEntry = Changelog::all()->last();
        if(!$lastEntry) {
            return 0;
        }
        return $lastEntry->minor_version;
    }

    /**
     * Gets the last patch version number
     *
     * @return int
     */
    private static function getPatchVersion()
    {
        $lastEntry = Changelog::all()->last();
        if(!$lastEntry) {
            return 0;
        }
        return $lastEntry->patch_version;
    }

    /**
     * Gets the number of days since the first commit on github
     *
     * @return int
     */
    private static function getDaysSinceInit()
    {
        return Carbon::parse('2020-10-03')->diffInDays(Carbon::now());
    }

    /**
     * Gets the prerelease status of the changelog version
     *
     * @param Request $request
     * @param Changelog $changelog
     * @return bool
     */
    private static function getPreReleaseStatus(Request $request)
    {
        $lastLog = Changelog::all()->last();
        if($lastLog != null && ($lastLog->prerelease == 0 && $request->prerelease == 1)) {
            throw new ChangelogHandlerException("Can not revert back to a prerelease status. The application has already been released!");
        }

        switch($request->prerelease) {
            case "1":
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Gets the changelog requests validation attribute names
     *
     * @return string[]
     */
    private static function getValidationAttributeNames()
    {
        return [
            'version_type' => 'Version Type',
            'change_type' => 'Change Type',
            'category' => 'Category',
            'description' => 'Changelog Description',
            'prerelease' => 'Prerelease Status',

        ];
    }

    /**
     * Gets the changelog validation rules.
     *
     * @return string[]
     */
    private static function getChangelogValidationRules()
    {
        return [
            'version_type' => 'required|string',
            'change_type' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string|max:1000',
            'prerelease' => 'required|in:1,0',
        ];
    }

    /**
     * Handle the change log requests fields from the store method
     *
     * @param Request $request
     * @param Changelog $changelog
     * @return Changelog
     */
    private static function handleChangelogRequestFields(Request $request, Changelog $changelog)
    {
        $version = self::getVersion($request);
        $changelog->major_version = $version['major_version'];
        $changelog->minor_version = $version['minor_version'];
        $changelog->patch_version = $version['patch_version'];
        $changelog->prerelease = $version['prerelease'];
        $changelog->days_since_init = $version['days_since_init'];
        $changelog->full_version_string = $version['full_version_string'];
        $changelog->version_type = $request->version_type;
        $changelog->change_type = $request->change_type;
        $changelog->category = $request->category;
        $changelog->description = $request->description;
        return $changelog;
    }

    /**
     * Updates an entry in the database
     *
     * @param Request $request
     * @param $log
     * @throws ChangelogHandlerException
     */
    public static function updateEntryInDatabase(Request $request, $log)
    {
        // Update the description, category, and change type
        $log->description = $request->description;
        $log->change_type = $request->change_type;
        $log->category = $request->category;
        // Check prerelease status of request
        $log->prerelease = self::checkUpdatePrereleaseStatus($request, $log);
        // Check to see if this version and the next version are prerelease conflicting
        $checkVersion = self::checkUpdateVersionNumber($request, $log);
        // Update the log compared to the previous log before it
        $log = self::updateLogVersionComparedToPrevious($request, $log);

        // If check update version numbers is true
        // Then we need to update all the rest of the rows in the database
        if($checkVersion) {
            self::updateVersionsAheadOfRequest($log);
        }
    }

    /**
     * Checks the previous and next post to make sure that versioning syntax remains constant.
     *
     * @param Request $request
     * @param $log
     * @return bool
     * @throws ChangelogHandlerException
     */
    private static function checkUpdatePrereleaseStatus(Request $request, $log)
    {
        $previousLog = Changelog::where('id', '<', $log->id)->get()->last();
        $nextLog = Changelog::where('id', '>', $log->id)->get()->first();

        if($previousLog->prerelease == 0 && $request->prerelease == 1) {
            throw new ChangelogHandlerException("You are trying to edit this changelog entry to make it a prerelease. The last version before this one is a live post-release version. Edit that version first and set its value to prerelease before editing this one.");
        }

        if($nextLog != null && ($nextLog->prerelease == 1 && $request->prerelease == 0)) {
            throw new ChangelogHandlerException("You are trying to edit this changelog entry to make it a post-release. The next entry is a prerelease status. Edit that entry and make it post-release before setting this entry as post-release.");
        }

        switch($request->prerelease) {
            case "1":
                return true;
                break;
            default:
                return false;
                break;
        }

    }

    /**
     * Checks to see if updating other rows in the database is necessary
     * Returning false = No update needed
     * Returning true = Update needed
     *
     * @param Request $request
     * @param $log
     * @return bool
     */
    private static function checkUpdateVersionNumber(Request $request, $log)
    {
        if($request->version_type == $log->version_type) {
            return false;
        }
        return true;
    }

    /**
     * Updates all entrys ahead of the log entry with new version numbers
     * Still keeps the same release day though...
     *
     * @param $log
     * @throws ChangelogHandlerException
     */
    private static function updateVersionsAheadOfRequest($log)
    {
        $logsAhead = Changelog::where('id', '>', $log->id)->get();
        $previousLog = $log;
        foreach($logsAhead as $logAhead) {
            $majorVersion = $previousLog->major_version;
            $minorVersion = $previousLog->minor_version;
            $patchVersion = $previousLog->patch_version;
            switch($logAhead->getRawOriginal('version_type')) {
                case "major":
                    $majorVersion++;
                    $minorVersion = 0;
                    $patchVersion = 0;
                    break;
                case "minor":
                    $minorVersion++;
                    $patchVersion = 0;
                    break;
                case "patch":
                    $patchVersion++;
                    break;
            }
            $logAhead->major_version = $majorVersion;
            $logAhead->minor_version = $minorVersion;
            $logAhead->patch_version = $patchVersion;
            $full_version_string = $majorVersion . '.';
            $full_version_string .= $minorVersion . '.';
            $full_version_string .= $patchVersion;
            $full_version_string .= ($logAhead->prerelease) ? '.b' : '';
            $full_version_string .= '-' . $log->days_since_init;
            $logAhead->full_version_string = $full_version_string;
            if(!$logAhead->save()) {
                throw new ChangelogHandlerException("Error when saving log at updateLogVersionComparedToPrevious() method.");
            }
            $previousLog = $logAhead;
        }
    }

    /**
     * Updates the log entry version compared to the previous version
     *
     * @param Request $request
     * @param $log
     * @return mixed
     * @throws ChangelogHandlerException
     */
    private static function updateLogVersionComparedToPrevious(Request $request, $log)
    {
        $previousLog = Changelog::where('id', '<', $log->id)->get()->last();
        $majorVersion = $previousLog->major_version;
        $minorVersion = $previousLog->minor_version;
        $patchVersion = $previousLog->patch_version;
        switch($request->version_type) {
            case "major":
                $majorVersion++;
                $minorVersion = 0;
                $patchVersion = 0;
                break;
            case "minor":
                $minorVersion++;
                $patchVersion = 0;
                break;
            case "patch":
                $patchVersion++;
                break;
        }
        $log->major_version = $majorVersion;
        $log->minor_version = $minorVersion;
        $log->patch_version = $patchVersion;
        $full_version_string = $majorVersion . '.';
        $full_version_string .= $minorVersion . '.';
        $full_version_string .= $patchVersion;
        $full_version_string .= ($request->prerelease) ? '.b' : '';
        $full_version_string .= '-' . $log->days_since_init;
        $log->full_version_string = $full_version_string;
        $log->version_type = $request->version_type;
        if(!$log->save()) {
            throw new ChangelogHandlerException("Error when saving log at updateLogVersionComparedToPrevious() method.");
        }
        return $log;
    }

    /**
     * Returns all version numbers sorted by major version
     *
     * @return array
     */
    public static function getAllVersionNumbers()
    {
        $versionNumbers = [];
        $previousVersions = Changelog::orderBy('major_version', 'desc')->get()->groupBy('major_version');
        foreach($previousVersions as $version => $data) {
            array_push($versionNumbers, $version);
        }
        return $versionNumbers;
    }
}
