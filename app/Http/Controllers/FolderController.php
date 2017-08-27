<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use Auth;
class FolderController extends Controller
{
    public function createFolder(Request $request) {
        $name = $request->input('name');
        $desc = $request->input('description');

        $folder = new Folder();
        $folder->folder_name = $name;
        $folder->folder_desc = $desc;
        $folder->category = 0;
        $folder->user_id = Auth::id();
        $folder->save();

        return response()->json(['msg' => 'Folder created.', 'status' => '200'], 200);
    }
}
