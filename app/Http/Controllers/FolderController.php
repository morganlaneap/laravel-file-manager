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
        $parent = $request->input('parent');


        $folder = new Folder();
        $folder->folder_name = $name;
        $folder->folder_desc = $desc;
        $folder->category = 0;
        $folder->user_id = Auth::id();
        $folder->parent_folder = $parent;
        $folder->save();

        return response()->json(['msg' => 'Folder created.', 'status' => '200'], 200);
    }

    public function getUserFolders(Request $request) {
        $folder = $request->input('folder');

        if ($folder == 0) {
            // get the parent folders
            $folders = Folder::where('parent_folder', '0')->where('user_id', Auth::id())->orderBy('folder_name', 'asc')->get();
        } else {
            $folders = Folder::where('parent_folder', $folder)->where('user_id', Auth::id())->orderBy('folder_name', 'asc')->get();
        }

        return $folders->toJson();
    }

    public function getParentFolderId(Request $request) {
        $folder = $request->input('folder');

        return Folder::where('id', $folder)->select('parent_folder')->firstOrFail();
    }

    public function renameFolder(Request $request) {
        $id = $request->input('id');
        $name = $request->input('name');

        $folder = Folder::where('id', $id)->first();

        $folder->folder_name = $name;
        $folder->save();

        return response()->json(['msg' => 'Folder renamed.', 'status' => '200'], 200);
    }

    public function getFolderName(Request $request) {
        $id = $request->input('id');

        if ($id == 0) {
            return response()->json(['folder_name' => 'My Files']);
        }

        $folder = Folder::where('id', $id)->select('folder_name')->firstOrFail();

        return $folder->toJson();
    }
}
