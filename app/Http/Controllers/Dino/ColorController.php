<?php

namespace App\Http\Controllers\Dino;

use App\Models\Ark\ArkDinoColor;
use App\Handlers\DinoColorHandler;
use App\Models\Dino\UserDinoColor;
use Illuminate\Support\Collection;
use App\Models\Ark\ArkDinoMetaInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use App\Exceptions\DinoColorHandlerException;
use Illuminate\Pagination\LengthAwarePaginator;

class ColorController extends Controller
{
    /**
     * Returns the INI file upload view to the user
     *
     * @return \Illuminate\View\View
     */
    public function uploadINI() {
        return view('color.upload');
    }

    /**
     * Parses INI file and then saves the data in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function parse(Request $request) {
        if(!$request->hasFile('inifile')) {
            Session::flash('warning', "You have not uploaded a file. Please upload a file to parse.");
            return redirect()->route('color.upload');
        }

        try {
            DinoColorHandler::validateFileIsIni($request->file('inifile'));
            $data = DinoColorHandler::parse($request->file('inifile'));
            DinoColorHandler::saveDinoToDatabase($data);
        } catch(DinoColorHandlerException $e) {
            return redirect()
                    ->route('color.upload')
                    ->withErrors(['message' => $e->getMessage()]);
        }

        Session::flash('success', "Successfully saved the colored dino to the database!");
        return redirect()->route('color.index');
    }

    /**
     * Returns the dino color index view to the user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index() {
        $user = Auth::user();

        $dinoNames = [];

        if($user->tribe_id != null) {
            $tribeDinos = UserDinoColor::where('tribe_id', $user->tribe_id)
                ->get()->groupBy('ark_dino_id');
            $personalDinos = UserDinoColor::where('user_id', $user->id)
                ->get()->groupBy('ark_dino_id');
            foreach($tribeDinos as $tribeDinoId => $tribeDinosSingular) {
                if(!array_key_exists($tribeDinoId, $dinoNames)) {
                    $metaInfo = ArkDinoMetaInfo::where('id', $tribeDinoId)->first();
                    $dinoNames[$tribeDinoId] = $metaInfo;
                }
            }
            foreach($personalDinos as $personalDinoId => $personalDinosSingular) {
                if(!array_key_exists($personalDinoId, $dinoNames)) {
                    $metaInfo = ArkDinoMetaInfo::where('id', $personalDinoId)->first();
                    $dinoNames[$personalDinoId] = $metaInfo;
                }
            }

        } else {
            $dinos = UserDinoColor::where('user_id', $user->id)
                ->paginate(10);
            foreach($dinos as $dino) {
                $dinoNames[$dino->ark_dino_id] = $dino->metaInfo;
            }
        }

        if(count($dinoNames) == 0) {
            Session::flash('warning', 'You have no saved dino colors lines in the database. Why not create one now?');
            return redirect()->route('color.upload');
        }
        return view('color.index')->withDinoNames($dinoNames);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function view($id) {
        $user = Auth::user();

        if($user->tribe_id != null) {
            $tribeDinos = UserDinoColor::where('ark_dino_id', $id)->where('tribe_id', $user->tribe_id)
                ->get();
            $personalDinos = UserDinoColor::where('ark_dino_id', $id)->where('user_id', $user->id)
                ->get();
            $collected = collect($tribeDinos->merge($personalDinos)->sortByDesc('created_at'));
            $dinos = $this->paginate($collected);
        } else {
            $dinos = UserDinoColor::where('ark_dino_id', $id)->where('user_id', $user->id)
                ->paginate(10);
        }

        $regionZeroIds = DinoColorHandler::getRegionIdsForDinos($dinos, 'zero');
        $regionOneIds = DinoColorHandler::getRegionIdsForDinos($dinos, 'one');
        $regionTwoIds = DinoColorHandler::getRegionIdsForDinos($dinos, 'two');
        $regionThreeIds = DinoColorHandler::getRegionIdsForDinos($dinos, 'three');
        $regionFourIds = DinoColorHandler::getRegionIdsForDinos($dinos, 'four');
        $regionFiveIds = DinoColorHandler::getRegionIdsForDinos($dinos, 'five');

        if($dinos->count() == 0) {
            Session::flash('warning', 'No saved dinos in the database for that ID');
            return redirect()->route('color.index');
        }

        $dinoBreed = UserDinoColor::where('ark_dino_id', $id)->first()->metaInfo->name;
        $colors = ArkDinoColor::all();
        return view('color.view')
                    ->withRegionZeroIds($regionZeroIds)
                    ->withRegionOneIds($regionOneIds)
                    ->withRegionTwoIds($regionTwoIds)
                    ->withRegionThreeIds($regionThreeIds)
                    ->withRegionFourIds($regionFourIds)
                    ->withRegionFiveIds($regionFiveIds)
                    ->withColors($colors)
                    ->withDinoBreed($dinoBreed);
    }
}
