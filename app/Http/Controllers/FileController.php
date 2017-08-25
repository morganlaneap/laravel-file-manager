<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFile(Request $request) {
        /*$this->validate($request,
            ['file' => 'required|max:10000'],
            ['file.required' => 'Please select at least one file to upload.']
        );*/

        $files = $request->file('files');


    }
}
