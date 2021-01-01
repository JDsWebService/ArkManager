<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ark\ArkDinoMetaInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImagesController extends Controller
{
    /**
     * Returns the Admin Image Manipulation Index
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('admin.images.index');
    }

    /**
     * Returns a new dino image
     *
     * @return mixed
     */
    public function getDinoInvertColorIndex() {
        $dino = ArkDinoMetaInfo::where('image_check', false)->orderBy('image_storage_path')->first();
        if($dino == null) {
            Session::flash('success', "You have sorted through all the dino images already!");
            return redirect()->route('admin.images.index');
        }
        return view('admin.images.dino.index')
                ->withDino($dino);
    }

    /**
     * Inverts the Ark Dino Image
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invertDinoImage($id) {
        $dino = ArkDinoMetaInfo::where('id', $id)->first();
        $imageFile = Storage::get($dino->image_storage_path);
        $image = Image::make($imageFile)->invert()->encode();
        Storage::put($dino->image_storage_path, $image);
        $dino->image_check = true;
        $dino->save();
        return redirect()->route('admin.images.dino.index');
    }

    /**
     * Skips the Dino Invert Process
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function skipDinoImage($id) {
        $dino = ArkDinoMetaInfo::where('id', $id)->first();
        $dino->image_check = true;
        $dino->save();
        return redirect()->route('admin.images.dino.index');
    }
}
