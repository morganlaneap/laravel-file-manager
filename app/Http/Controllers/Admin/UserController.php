<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index() {
        return view('admin.users');
    }

    public function getUsers(Request $request) {
        $search = $request->input('searchString');

        $users = User::where('name', 'like', '%' . $search . '%')->get();

        return $users->toJson();
    }

    public function getUserInfo(Request $request, $id) {
        $user = User::find($id);

        return view('admin.viewuser')->with('user', $user);
    }

    public function saveUserInfo(Request $request) {
        $id = $request->input('userId');
        $quota = $request->input('userQuota');

        $user = User::where('id', $id)->first();
        $user->disk_quota = $quota;
        $user->save();

        return response()->json(['msg' => 'User updated.', 'status'=>'200'], 200);
    }
}
