<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Auth;

class FileController extends Controller
{
    public function uploadFile(Request $request) {
        if ($request->hasFile('file')) {

            $path = $request->file('file')->store('uploads');

            $path = str_replace("uploads/", "", $path);

            $size = $request->file('file')->getClientSize();
            $fileName = $request->file('file')->getClientOriginalName();
            $fileExt = $request->file('file')->getClientOriginalExtension();

            $file = new File();
            $file->user_id = Auth::id();
            $file->folder_id = 0;
            $file->file_name = $fileName;
            $file->file_extension = $fileExt;
            $file->file_size = $size;
            $file->file_hash = $path;
            $file->save();

            return response()->json(['msg' => 'File uploaded.', 'status' => '200'], 200);
        } else {
            return response()->json(['msg' => 'No file was specified.', 'status' => '500'], 500);
        }
    }
}
