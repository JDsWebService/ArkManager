<?php


namespace App\Handlers;


use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Dino\UserDino;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DinoHandler
{

    /**
     * Stores a new base dino into the database
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public static function storeNewBaseDino(\Illuminate\Http\Request $request)
    {
        // Clean up the request
        FormHandler::clean($request);
        // Validate the request
        self::validateNewBaseDinoRequest($request);
        // Generate data to be stored into the dino instance
        $generate = self::generateData($request);
        // Create new UserDino instance
        $dino = new UserDino;
        // Handle all required fields
        $dino->user_tribe_id = TribeHandler::getTribeID();
        $dino->user_id = UserHandler::getUserID();
        $dino->dino_meta_info_id = $request->dino_meta_info_id;
        $dino->uuid = $generate['uuid'];
        $dino->slug = $generate['slug'];
        $dino->name = $generate['name'];
        $dino->mutation_type = $request->mutation_type;
        $dino->mutation_count = 0;
        $dino->level = $request->level;
        // Handle Dino Stats Fields
        $dino = self::handleDinoStatsFields($dino, $request);

        return $dino->save();
    }

    /**
     * Updates a base dino in the database
     *
     * @param \Illuminate\Http\Request $request
     * @param $slug
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function updateBaseDino(\Illuminate\Http\Request $request, $slug)
    {
        // Clean up the request
        FormHandler::clean($request);
        // Validate the request
        self::validateUpdateBaseDinoRequest($request);
        // Generate data to be stored into the dino instance
        $generate = self::generateData($request);
        // Create new UserDino instance
        $dino = UserDino::where('slug', $slug)->firstOrFail();
        // Handle all required fields
        $dino->user_id = UserHandler::getUserID();
        $dino->level = $request->level;
        // Handle Dino Stats Fields
        $dino = self::handleDinoStatsFields($dino, $request);

        return $dino->save();
    }

    /**
     * Adds a new mutated dino to the database
     *
     * @param \Illuminate\Http\Request $request
     * @param $uuid
     * @return bool
     * @throws ValidationException
     */
    public static function storeNewMutatedDino(\Illuminate\Http\Request $request, $uuid)
    {
        $newestDino = UserDino::where('uuid', $uuid)->orderBy('mutation_count', 'desc')->first();
        // Clean up the request
        FormHandler::clean($request);
        // Validate the request
        self::validateNewMutatedDinoRequest($request);
        self::validateNewMutatedDinoStats($request, $newestDino);
        // Generate data to be stored into the dino instance
        $generate = self::generateData($request, $newestDino);
        // Create new UserDino instance
        $dino = new UserDino;
        // Handle all required fields
        $dino->user_tribe_id = TribeHandler::getTribeID();
        $dino->user_id = UserHandler::getUserID();
        $dino->dino_meta_info_id = $newestDino->dino_meta_info_id;
        $dino->uuid = $generate['uuid'];
        $dino->slug = $generate['slug'];
        $dino->name = $generate['name'];
        $dino->mutation_type = $request->mutation_type;
        $dino->mutation_count = $newestDino->nextMutationCount;
        $dino->level = $request->level;
        // Handle Dino Stats Fields
        $dino = self::handleDinoStatsFields($dino, $request);

        return $dino->save();
    }

    /**
     * Updates a mutated dino in the database
     *
     * @param \Illuminate\Http\Request $request
     * @param $slug
     * @return mixed
     * @throws ValidationException
     */
    public static function updateMutatedDino(\Illuminate\Http\Request $request, $slug)
    {
        $mutatedDino = UserDino::where('slug', $slug)->first();
        // Clean up the request
        FormHandler::clean($request);
        // Validate the request
        self::validateUpdateMutatedDinoRequest($request);
        self::validateUpdateMutatedDinoStats($request, $mutatedDino);
        // Handle all required fields
        $mutatedDino->user_id = UserHandler::getUserID();
        if($request->level != null) {
            $mutatedDino->level = $request->level;
        }
        // Handle Dino Stats Fields
        $mutatedDino = self::handleUpdateMutatedDinoStatsFields($mutatedDino, $request);
        return $mutatedDino->save();
    }

    /**
     * Checks to see if there are any dino stats set to 0
     *
     * @param $dino
     * @return bool
     */
    public static function checkIfStatsAreOmitted($dino)
    {
        $omittedStats = false;
        ($dino->health == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->stamina == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->torpidity == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->oxygen == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->food == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->water == 0 || $dino->water == 100 ? $omittedStats = true : $omittedStats = false);
        ($dino->temperature == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->weight == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->damage == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->movement == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->fortitude == 0 ? $omittedStats = true : $omittedStats = false);
        ($dino->crafting == 0 ? $omittedStats = true : $omittedStats = false);
        return $omittedStats;
    }

    /**
     * Validates the new base dino request
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private static function validateNewBaseDinoRequest(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make($request->all(),
            self::getNewBaseDinoValidationRules($request));
        $validator->setAttributeNames(self::getValidationAttributeNames());
        return $validator->validate();
    }

    /**
     * Validates the update base dino request
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private static function validateUpdateBaseDinoRequest(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make($request->all(),
            self::getUpdateBaseDinoValidationRules($request));
        $validator->setAttributeNames(self::getValidationAttributeNames());
        return $validator->validate();
    }

    /**
     * Validates the new mutated dino request
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws ValidationException
     */
    private static function validateNewMutatedDinoRequest(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make($request->all(),
            self::getNewMutatedDinoValidationRules($request));
        $validator->setAttributeNames(self::getValidationAttributeNames());
        return $validator->validate();
    }

    /**
     * Validates an update mutated dino request
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws ValidationException
     */
    private static function validateUpdateMutatedDinoRequest(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make($request->all(),
            self::getUpdatedMutatedDinoValidationRules($request));
        $validator->setAttributeNames(self::getValidationAttributeNames());
        return $validator->validate();
    }

    /**
     * Gets the validation rules for a new base dino
     *
     * @param \Illuminate\Http\Request $request
     * @return string[]
     */
    private static function getNewBaseDinoValidationRules(\Illuminate\Http\Request $request)
    {
        $rules = [
            'dino_meta_info_id' => 'required|integer',
            'mutation_type' => 'required|string',
            'level' => 'required|integer|min:1',
            'health' => 'nullable|numeric|min:1',
            'stamina' => 'nullable|numeric|min:1',
            'torpidity' => 'nullable|numeric|min:1',
            'oxygen' => 'nullable|numeric|min:1',
            'food' => 'nullable|numeric|min:1',
            'water' => 'nullable|numeric|min:1',
            'temperature' => 'nullable|numeric|min:1',
            'weight' => 'nullable|numeric|min:1',
            'damage' => 'nullable|numeric|min:1',
            'movement' => 'nullable|numeric|min:1',
            'fortitude' => 'nullable|numeric|min:1',
            'crafting' => 'nullable|numeric|min:1',
        ];
        $rules[$request->mutation_type] = 'required|numeric|min:1';
        return $rules;
    }

    /**
     * Gets the validation rules for updating a base dino
     *
     * @param \Illuminate\Http\Request $request
     * @return string[]
     */
    private static function getUpdateBaseDinoValidationRules(\Illuminate\Http\Request $request)
    {
        $rules = [
            'level' => 'required|integer|min:1',
            'health' => 'nullable|numeric',
            'stamina' => 'nullable|numeric',
            'torpidity' => 'nullable|numeric',
            'oxygen' => 'nullable|numeric',
            'food' => 'nullable|numeric',
            'water' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'damage' => 'nullable|numeric',
            'movement' => 'nullable|numeric',
            'fortitude' => 'nullable|numeric',
            'crafting' => 'nullable|numeric',
        ];
        $rules[$request->mutation_type] = 'required|numeric|min:1';
        return $rules;
    }

    /**
     * Gets the validation rules for adding a new mutated dino to a breeding line
     *
     * @param \Illuminate\Http\Request $request
     * @return string[]
     */
    private static function getNewMutatedDinoValidationRules(\Illuminate\Http\Request $request)
    {
        $rules = [
            'level' => 'required|integer|min:1',
            'health' => 'nullable|numeric|min:1',
            'stamina' => 'nullable|numeric|min:1',
            'torpidity' => 'nullable|numeric|min:1',
            'oxygen' => 'nullable|numeric|min:1',
            'food' => 'nullable|numeric|min:1',
            'water' => 'nullable|numeric|min:1',
            'temperature' => 'nullable|numeric|min:1',
            'weight' => 'nullable|numeric|min:1',
            'damage' => 'nullable|numeric|min:1',
            'movement' => 'nullable|numeric|min:1',
            'fortitude' => 'nullable|numeric|min:1',
            'crafting' => 'nullable|numeric|min:1',
        ];
        $rules[$request->mutation_type] = 'required|numeric|min:1';
        return $rules;
    }

    /**
     * Gets the validation rules for updating a new mutated dino to a breeding line
     *
     * @param \Illuminate\Http\Request $request
     * @return string[]
     */
    private static function getUpdatedMutatedDinoValidationRules(\Illuminate\Http\Request $request)
    {
        $rules = [
            'level' => 'nullable|integer|min:1',
            'health' => 'nullable|numeric|min:1',
            'stamina' => 'nullable|numeric|min:1',
            'torpidity' => 'nullable|numeric|min:1',
            'oxygen' => 'nullable|numeric|min:1',
            'food' => 'nullable|numeric|min:1',
            'water' => 'nullable|numeric|min:1',
            'temperature' => 'nullable|numeric|min:1',
            'weight' => 'nullable|numeric|min:1',
            'damage' => 'nullable|numeric|min:1',
            'movement' => 'nullable|numeric|min:1',
            'fortitude' => 'nullable|numeric|min:1',
            'crafting' => 'nullable|numeric|min:1',
        ];
        $rules[$request->mutation_type] = 'required|numeric|min:1';
        return $rules;
    }

    /**
     * Sets the appropriate Validation Attributes Names to be used by
     * the Validator::make()->setAttributesNames() method.
     *
     * @return string[]
     */
    private static function getValidationAttributeNames() {
        return [
            'level' => 'Dino Level',
            'health' => 'Health',
            'stamina' => 'Stamina',
            'torpidity' => 'Torpidity',
            'oxygen' => 'Oxygen',
            'food' => 'Food',
            'water' => 'Water',
            'temperature' => 'Temperature',
            'weight' => 'Weight',
            'damage' => 'Melee Damage',
            'movement' => 'Movement Speed',
            'fortitude' => 'Fortitude',
            'crafting' => 'Crafting Skill',
        ];
    }

    /**
     * Generates any data that needs to be stored such as a UUID or a slug.
     *
     * @param \Illuminate\Http\Request $request
     * @param UserDino|null $dino UserDino instance
     * @return array
     */
    private static function generateData(\Illuminate\Http\Request $request, UserDino $dino = null)
    {
        $uuid = ($dino == null ? Str::uuid()->toString() : $dino->uuid);
        $slug = $uuid . '-' . UserHandler::getUserID() . '-' .Carbon::now()->timestamp;
        $name = ($dino == null ? 'Base Dino' : $dino->mutation_type . ' ' . $dino->nextMutationCount . '/X');
        return [
            'uuid' => $uuid,
            'slug' => $slug,
            'name' => $name,
        ];
    }

    /**
     * Handles all dino stats fields to be entered into the database.
     * Each value will default to 0 if the request value is equal to NULL.
     *
     * @param UserDino $dino
     * @param \Illuminate\Http\Request $request
     * @return UserDino
     */
    private static function handleDinoStatsFields(UserDino $dino, \Illuminate\Http\Request $request)
    {
        $dino->health = ($request->health == null ? 0 : $request->health);
        $dino->stamina = ($request->stamina == null ? 0 : $request->stamina);
        $dino->torpidity = ($request->torpidity == null ? 0 : $request->torpidity);
        $dino->oxygen = ($request->oxygen == null ? 0 : $request->oxygen);
        $dino->food = ($request->food == null ? 0 : $request->food);
        $dino->water = ($request->water == null ? 0 : $request->water);
        $dino->temperature = ($request->temperature == null ? 0 : $request->temperature);
        $dino->weight = ($request->weight == null ? 0 : $request->weight);
        $dino->damage = ($request->damage == null ? 0 : $request->damage);
        $dino->movement = ($request->movement == null ? 0 : $request->movement);
        $dino->fortitude = ($request->fortitude == null ? 0 : $request->fortitude);
        $dino->crafting = ($request->crafting == null ? 0 : $request->crafting);
        return $dino;
    }

    /**
     * Handles update mutated dino stats fields to be entered into the database.
     * If the request stat is null, returns the previously stored data back
     * instead of assigning the value to the request.
     *
     * @param $mutatedDino
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    private static function handleUpdateMutatedDinoStatsFields($mutatedDino, \Illuminate\Http\Request $request)
    {
        $mutatedDino->health = ($request->health == null ? $mutatedDino->health : $request->health);
        $mutatedDino->stamina = ($request->stamina == null ? $mutatedDino->stamina : $request->stamina);
        $mutatedDino->torpidity = ($request->torpidity == null ? $mutatedDino->torpidity : $request->torpidity);
        $mutatedDino->oxygen = ($request->oxygen == null ? $mutatedDino->oxygen : $request->oxygen);
        $mutatedDino->food = ($request->food == null ? $mutatedDino->food : $request->food);
        $mutatedDino->water = ($request->water == null ? $mutatedDino->water : $request->water);
        $mutatedDino->temperature = ($request->temperature == null ? $mutatedDino->temperature : $request->temperature);
        $mutatedDino->weight = ($request->weight == null ? $mutatedDino->weight : $request->weight);
        $mutatedDino->damage = ($request->damage == null ? $mutatedDino->damage : $request->damage);
        $mutatedDino->movement = ($request->movement == null ? $mutatedDino->movement : $request->movement);
        $mutatedDino->fortitude = ($request->fortitude == null ? $mutatedDino->fortitude : $request->fortitude);
        $mutatedDino->crafting = ($request->crafting == null ? $mutatedDino->crafting : $request->crafting);
        return $mutatedDino;
    }

    /**
     * Checks if the mutated dinos stats from the request are valid
     * against the newest dino in the breeding line.
     *
     * @param \Illuminate\Http\Request $request
     * @param UserDino $newestDino UserDino - Newest Dino In Line
     * @throws ValidationException
     */
    private static function validateNewMutatedDinoStats(\Illuminate\Http\Request $request, UserDino $newestDino)
    {
        // Define some variables to be used later
        $exceptionMessages = [];

        // Check Level
        $validLevels = [
            $newestDino->level + 2,
            $newestDino->level + 4,
        ];
        if(!in_array($request->level, $validLevels)) {
            array_push($exceptionMessages, "Mutated dino level must be +2 or +4 levels above the newest dino's level ({$newestDino->level}) in the line. Valid levels are: {$validLevels[0]} or {$validLevels[1]}");
        }

        // Loop through all the invalid stats
        foreach(self::getMutationTypes() as $mutation) {
            if($request->{$mutation} != null) {
                if($request->{$mutation} < $newestDino->{$mutation}) {
                    array_push($exceptionMessages, "Mutated dino's {$mutation} stat ({$request->{$mutation}}) is lower then the newest dino's {$mutation} stat ({$newestDino->{$mutation}}). Value must be higher.");
                }
            }
        }

        // If theres any exception messages
        if(!empty($exceptionMessages)) {
            throw ValidationException::withMessages(['message' => $exceptionMessages]);
        }

    }

    /**
     * Checks if the mutated dino stats from the request are valid
     * against the newest and previous dino in the breeding line.
     *
     * @param \Illuminate\Http\Request $request
     * @param $mutatedDino
     * @throws ValidationException
     */
    private static function validateUpdateMutatedDinoStats(\Illuminate\Http\Request $request, $mutatedDino)
    {
        // Define some variables to be used later
        $exceptionMessages = [];
        $uuid = $mutatedDino->uuid;
        $previousDino = UserDino::where('uuid', $uuid)
            ->where('mutation_count', $mutatedDino->mutation_count - 1)
            ->first();
        $newestDino = UserDino::where('uuid', $uuid)
            ->orderBy('mutation_count', 'desc')
            ->first();
        if($newestDino->slug == $mutatedDino->slug) {
            $newestDino = null;
        }

        // Check Level
        if($request->level != null) {
            $previousDinoValidLevels = [
                $mutatedDino->level + 2,
                $mutatedDino->level + 4,
            ];
            $newestDinoValidLevels = [
                ($mutatedDino->level - 2 <= 0) ? 1 : $mutatedDino->level - 2,
                ($mutatedDino->level - 4 <= 0) ? 1 : $mutatedDino->level - 4,
            ];
            // Invalid Level Handling
            if(!in_array($request->level, $previousDinoValidLevels)) {
                array_push($exceptionMessages, "Mutated dino level ({$request->level}) must be either +2 or +4 levels above the previous dino's level ({$previousDino->level}) in the line. Valid levels are: {$previousDinoValidLevels[0]} or {$previousDinoValidLevels[1]}");
            }
            if($newestDino != null) {
                if(!in_array($request->level, $newestDinoValidLevels)) {
                    array_push($exceptionMessages, "Mutated dino level ({$request->level}) must be either -2 or -4 levels below the newest dino's level ({$newestDino->level}) in the line. Valid levels are: {$newestDinoValidLevels[0]} or {$newestDinoValidLevels[1]}");
                }
            }
            // Valid Level Handling
            if(in_array($request->level, $previousDinoValidLevels) || in_array($request->level, $newestDinoValidLevels) || $request->level == $mutatedDino->level) {
                // Reset all exceptions
                $exceptionMessages = [];
            }
        }

        // Loop through all the invalid stats
        foreach(self::getMutationTypes() as $mutation) {
            if($request->{$mutation} != null) {
                // Check if value is lower then previous dinos stats
                if($request->{$mutation} <= $previousDino->{$mutation}) {
                    array_push($exceptionMessages, "Mutated dino's {$mutation} stat ({$request->{$mutation}}) is lower then or equal to the previous dino's {$mutation} stat ({$previousDino->{$mutation}}). Value must be higher.");
                }
                // Check if value is higher then newest dinos stats
                if($newestDino != null) {
                    if($request->{$mutation} >= $newestDino->{$mutation}) {
                        array_push($exceptionMessages, "Mutated dino's {$mutation} stat ({$request->{$mutation}}) is higher then or equal to the newest dino's {$mutation} stat ({$newestDino->{$mutation}}). Value must be lower.");
                    }
                }
            }
        }

        // If theres any exception messages
        if(!empty($exceptionMessages)) {
            throw ValidationException::withMessages(['message' => $exceptionMessages]);
        }
    }

    /**
     * Returns an array of all valid mutation types
     *
     * @return string[]
     */
    private static function getMutationTypes()
    {
        return [ 'health', 'stamina', 'torpidity', 'oxygen', 'food', 'water', 'temperature', 'weight', 'damage', 'movement', 'fortitude', 'crafting'];
    }


}
