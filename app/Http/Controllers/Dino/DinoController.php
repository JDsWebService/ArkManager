<?php

namespace App\Http\Controllers\Dino;

use App\Handlers\DinoHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class DinoController extends Controller
{
    /**
     * Returns the Import Form
     *
     * @return mixed
     */
    public function import() {
        return view('dino.import');
    }

    public function parse(Request $request) {
        // Validate that a file was passed
        $this->validate($request, [
            'fileUpload' => 'required|file'
        ]);

        // Assign the file to a variable
        $file = $request->file('fileUpload');

        // Check the file type
        if($file->getClientOriginalExtension() != 'ini'){
            return back()->withErrors(['msg' => 'Uploaded file is not an INI file.']);
        }

        // Get File Contents
        try {
            $contents = DinoHandler::parseIni(File::get($file));
        } catch (FileNotFoundException $exception) {
            dd($exception->getMessage());
        }

        dd($contents);
    }
}
