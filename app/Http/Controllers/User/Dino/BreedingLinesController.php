<?php

namespace App\Http\Controllers\User\Dino;

use Carbon\Carbon;
use App\Models\Ark\Dino;
use Illuminate\Support\Str;
use App\Models\User\Dino\Line;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BreedingLinesController extends Controller
{
    /**
     * Returns the index view.
     *
     * @return mixed
     */
    public function index() {
        $lines = Line::where('tribe_id', Auth::user()->tribe->id)->paginate(10);
        if($lines->count() == 0) {
            Session::flash('warning', "You don't have any breeding lines in our database. Consider adding one by using this form here!");
            return redirect()->route('dino.line.new');
        }
        return view('dino.line.index')->withLines($lines);
    }

    /**
     * Shows the New Breeding Line View.
     * This view asks the user to select the dino type of the line.
     *
     * @return mixed
     */
    public function new() {
        $dinos = Dino::orderBy('dlc_name', 'asc')->orderBy('name', 'asc')->get(['name', 'ark_id', 'is_dlc', 'dlc_name']);

        return view('dino.line.new')->withDinos($dinos);
    }

    /**
     * Redirects to the appropriate Base Stats Input Form depending on type of dino selected
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function typeselection(Request $request) {
        $dino = Dino::where('ark_id', $request->ark_id)->first();

        return redirect()->route('dino.line.basestatinput', ['dino_name' => $dino->name]);
    }

    /**
     * Edits the selected breeding line.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($slug) {
        $line = Line::where('slug', $slug)->first();
        if(Auth::user()->id != $line->user_id) {
            Session::flash('danger', 'You are not the owner of this line!');
            return redirect()->route('dino.line.index');
        }
        $dino = $line->dino;
        $mutationTypes = $this->getMutationTypes();
        return view('dino.line.baseStatInput')
                ->withDino($dino)
                ->withMutationTypes($mutationTypes)
                ->withLine($line);
    }

    /**
     * Returns the view of the Base Stats Input Form.
     *
     * @param Request $request
     * @return mixed
     */
    public function basestatinput(Request $request) {
        $dino = Dino::where('name', $request->route('dino_name'))->first();
        $mutationTypes = $this->getMutationTypes();
        return view('dino.line.baseStatInput')
                ->withDino($dino)
                ->withMutationTypes($mutationTypes);
    }

    /**
     * Stores the new breeding line into the database.
     *
     * @param Request $request
     */
    public function store(Request $request) {
        $this->validate($request, [
           'base_level' => 'required|numeric',
           'dino_ark_id' => 'required',
           'mutation_type' => 'required|string'
        ]);

        $user = Auth::user();
        $tribe = $user->tribe;
        $dino = Dino::where('ark_id', $request->dino_ark_id)->first();

        if($request->_method == 'PUT') {
            $line = Line::where('slug', $request->line_slug)->first();
        } else {
            $line = new Line;
        }

        $line->user_id = $user->id;
        $line->tribe_id = $tribe->id;
        $line->ark_dino_id = $dino->id;
        $line->slug = Str::slug($tribe->name . '-' . $dino->name . '-' . $request->mutation_type . '-' . Carbon::now());
        $line->mutation_type = $request->mutation_type;
        $line->base_level = Purifier::clean($request->base_level);

        if($tribe->use_true_values) {
            $line = $this->handleTrueValues($line, $request);
        }
        if($tribe->use_stat_levels) {
            $line = $this->handleStatLevels($line, $request);
        }

        $line->save();

        Session::flash('success', 'You have saved the breeding line successfully!');
        return redirect()->route('dino.line.index');
    }

    /**
     * Gets the dino mutation types.
     *
     * @return string[]
     */
    private function getMutationTypes() {
        return [
            'health' => 'Health',
            'stamina' => 'Stamina',
            'food' => 'Food',
            'weight' => 'Weight',
            'damage' => 'Melee Damage',
            'movement' => 'Movement Speed',
            'crafting' => 'Crafting Skill',
        ];
    }

    /**
     * Handles the requests True Values section and returns the line.
     *
     * @param Line $line
     * @param Request $request
     * @return Line
     * @throws \Illuminate\Validation\ValidationException
     */
    private function handleTrueValues(Line $line, Request $request) {
        $this->validate($request, [
            'base_health_true_value' => 'required|numeric',
            'base_stamina_true_value' => 'required|numeric',
            'base_oxygen_true_value' => 'nullable|numeric',
            'base_food_true_value' => 'required|numeric',
            'base_weight_true_value' => 'required|numeric',
            'base_damage_true_value' => 'required|numeric',
            'base_movement_true_value' => 'nullable|numeric',
            'base_water_true_value' => 'nullable|numeric',
            'base_torpidity_true_value' => 'nullable|numeric',
            'base_fortitude_true_value' => 'nullable|numeric',
            'base_crafting_true_value' => 'nullable|numeric',
        ]);

        $line->base_health_true_value = Purifier::clean($request->base_health_true_value);
        $line->base_stamina_true_value = Purifier::clean($request->base_stamina_true_value);
        // Nullable
        $line->base_oxygen_true_value = $this->handleNullableField($request->base_oxygen_true_value);
        $line->base_food_true_value = Purifier::clean($request->base_food_true_value);
        $line->base_weight_true_value = Purifier::clean($request->base_weight_true_value);
        $line->base_damage_true_value = Purifier::clean($request->base_damage_true_value);
        $line->base_movement_true_value = Purifier::clean($request->base_movement_true_value);
        // Nullable
        $line->base_water_true_value = $this->handleNullableField($request->base_water_true_value);
        $line->base_torpidity_true_value = $this->handleNullableField($request->base_torpidity_true_value);
        $line->base_fortitude_true_value = $this->handleNullableField($request->base_fortitude_true_value);
        $line->base_crafting_true_value = $this->handleNullableField($request->base_crafting_true_value);

        return $line;

    }

    /**
     * Handles the requests Stat Levels section and returns the line.
     *
     * @param Line $line
     * @param Request $request
     * @return Line
     * @throws \Illuminate\Validation\ValidationException
     */
    private function handleStatLevels(Line $line, Request $request) {
        $this->validate($request, [
            'base_health_stat_level' => 'required|numeric',
            'base_stamina_stat_level' => 'required|numeric',
            'base_oxygen_stat_level' => 'nullable|numeric',
            'base_food_stat_level' => 'required|numeric',
            'base_weight_stat_level' => 'required|numeric',
            'base_damage_stat_level' => 'required|numeric',
            'base_movement_stat_level' => 'nullable|numeric',
            'base_water_stat_level' => 'nullable|numeric',
            'base_torpidity_stat_level' => 'nullable|numeric',
            'base_fortitude_stat_level' => 'nullable|numeric',
            'base_crafting_stat_level' => 'nullable|numeric',
        ]);

        $line->base_health_stat_level = Purifier::clean($request->base_health_stat_level);
        $line->base_stamina_stat_level = Purifier::clean($request->base_stamina_stat_level);
        // Nullable
        $line->base_oxygen_stat_level = $this->handleNullableField($request->base_oxygen_stat_level);
        $line->base_food_stat_level = Purifier::clean($request->base_food_stat_level);
        $line->base_weight_stat_level = Purifier::clean($request->base_weight_stat_level);
        $line->base_damage_stat_level = Purifier::clean($request->base_damage_stat_level);
        $line->base_movement_stat_level = Purifier::clean($request->base_movement_stat_level);
        // Nullable
        $line->base_water_stat_level = $this->handleNullableField($request->base_water_stat_level);
        $line->base_torpidity_stat_level = $this->handleNullableField($request->base_torpidity_stat_level);
        $line->base_fortitude_stat_level = $this->handleNullableField($request->base_fortitude_stat_level);
        $line->base_crafting_stat_level = $this->handleNullableField($request->base_crafting_stat_level);

        return $line;
    }

    /**
     * Cleans up nullable fields so that there are no SQL errors due to column type constraints
     *
     * @param $value
     * @return mixed|null
     */
    private function handleNullableField($value) {
        if($value != null || $value != "") {
            return Purifier::clean($value);
        }
        return null;
    }

    public function destroy($slug) {
        $line = Line::where('slug', $slug)->first();

        $line->delete();
        Session::flash('success', 'Removed the breeding line successfully!');
        return redirect()->route('dino.line.index');
    }
}
