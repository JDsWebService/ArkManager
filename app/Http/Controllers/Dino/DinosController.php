<?php

namespace App\Http\Controllers\Dino;

use App\Handlers\DinoHandler;
use App\Handlers\FormHandler;
use App\Models\Dino\UserDino;
use App\Models\Ark\ArkDinoMetaInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DinosController extends Controller
{
    /**
     * Returns the dinos index view to the user.
     *
     * @return mixed
     */
    public function index() {
        $baseDinos = UserDino::where('mutation_count', 0)->orderBy('created_at')->paginate(10);
        if($baseDinos->count() == 0) {
            Session::flash('warning', 'You have no saved breeding lines in the database. Why not create one now?');
            return redirect()->route('dino.new.base');
        }
        return view('dino.index')->withBaseDinos($baseDinos);
    }

    /**
     * Returns the new base dino form to the user
     *
     * @return mixed
     */
    public function newBaseDino() {
        $dinoMetaData = ArkDinoMetaInfo::orderBy('dlc_name', 'asc')
                                        ->orderBy('name', 'asc')
                                        ->get(['name', 'id', 'is_dlc', 'dlc_name']);
        // Return new base dino view
        return view('dino.new.baseDino')->withDinoMetaData($dinoMetaData);
    }

    /**
     * Stores a new base dino into the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeBaseDino(Request $request) {
        if(DinoHandler::storeNewBaseDino($request)) {
            Session::flash('success', 'Added the Base Dino to the database!');
            return redirect()->route('dino.index');
        }
    }

    /**
     * Returns the show breeding line view to the user
     *
     * @param $uuid UUID of the breeding line
     * @return mixed
     */
    public function showLine($uuid) {
        $dinos = UserDino::where('uuid', $uuid)->get();
        $baseDino = $dinos->where('mutation_count', 0)->first();
        $omittedStats = DinoHandler::checkIfStatsAreOmitted($baseDino);
        $mutatedDinos = $dinos->where('mutation_count', '>', 0);
        return view('dino.show.line')
                ->withBaseDino($baseDino)
                ->withMutatedDinos($mutatedDinos)
                ->withOmittedStats($omittedStats);
    }

    /**
     * Returns the edit base dino form view to the user
     *
     * @param $slug
     * @return mixed
     */
    public function editBaseDino($slug) {
        $baseDino = UserDino::where('slug', $slug)->firstOrFail();
        return view('dino.edit.baseDino')->withBaseDino($baseDino);
    }

    /**
     * Updates a base dino in the database
     *
     * @param Request $request
     * @param $slug UserDino Model Slug Field
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateBaseDino(Request $request, $slug) {
        $uuid = UserDino::where('slug', $slug)->first()->uuid;
        if(DinoHandler::updateBaseDino($request, $slug)) {
            Session::flash('success', 'Updated the base dino successfully!');
            return redirect()->route('dino.show.line', $uuid);
        }
    }

    /**
     * Deletes all dinos in a breeding line from the database
     *
     * @param $uuid UUID of the line to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyLine($uuid) {
        $dinos = UserDino::where('uuid', $uuid)->get();
        $i = 0;
        foreach($dinos as $dino) {
            $dino->delete();
            $i++;
        }
        Session::flash('success', "You have successfully deleted this dino line, removing {$i} entries from the database.");
        return redirect()->route('dino.index');
    }

    /**
     * Returns the new mutated dino form to the user
     *
     * @param $uuid
     * @return mixed
     */
    public function newMutatedDino($uuid) {
        $baseDino = UserDino::where('uuid', $uuid)->where('mutation_count', 0)->first();
        $newestDino = UserDino::where('uuid', $uuid)->orderBy('mutation_count', 'desc')->first();
        return view('dino.new.mutatedDino')
                ->withNewestDino($newestDino)
                ->withBaseDino($baseDino);
    }

    /**
     * Stores a new mutated dino into the database
     *
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeMutatedDino(Request $request, $uuid) {
        if(DinoHandler::storeNewMutatedDino($request, $uuid)) {
            Session::flash('success', 'Adding the new mutation successfully!');
            return redirect()->route('dino.show.line', $uuid);
        }
    }

    /**
     * Returns the edit mutated dino form view
     *
     * @param $slug
     * @return mixed
     */
    public function editMutatedDino($slug) {
        $mutatedDino = UserDino::where('slug', $slug)->firstOrFail();
        $uuid = $mutatedDino->uuid;
        $baseDino = UserDino::where('uuid', $uuid)
                        ->where('mutation_count', 0)
                        ->first();
        $previousDino = UserDino::where('uuid', $uuid)
                        ->where('mutation_count', $mutatedDino->mutation_count - 1)
                        ->first();
        $newestDino = UserDino::where('uuid', $uuid)
                        ->orderBy('mutation_count', 'desc')
                        ->first();
        if($newestDino->slug == $mutatedDino->slug) {
            $newestDino = null;
        }
        return view('dino.edit.mutatedDino')
                ->withMutatedDino($mutatedDino)
                ->withBaseDino($baseDino)
                ->withPreviousDino($previousDino)
                ->withNewestDino($newestDino);
    }

    /**
     * Updates the mutated dino in the database
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMutatedDino(Request $request, $slug) {
        $uuid = UserDino::where('slug', $slug)->first()->uuid;
        if(DinoHandler::updateMutatedDino($request, $slug)) {
            Session::flash('success', 'Updated the mutated dino successfully!');
            return redirect()->route('dino.show.line', $uuid);
        }
    }

    /**
     * Deletes the specified mutated dino plus all dinos with
     * a mutation count greater then the speficied mutated dino
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMutatedDino($slug) {
        $mutatedDino = UserDino::where('slug', $slug)->first();
        $uuid = $mutatedDino->uuid;
        $dinosToBeDeleted = UserDino::where('uuid', $uuid)->where('mutation_count', '>', $mutatedDino->mutation_count)->get();
        $i = 1;
        if($dinosToBeDeleted->count() != 0) {
            foreach($dinosToBeDeleted as $dino) {
                $dino->delete();
                $i++;
            }
        }
        $mutatedDino->delete();
        Session::flash('success', "You have successfully deleted the mutated dino(s), removing {$i} entries from the database.");
        return redirect()->route('dino.show.line', $uuid);
    }
}
