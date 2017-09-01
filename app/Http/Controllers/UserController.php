<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    public function index() {
      return view('profile');
    }

    public function updateProfile(Request $request) {
        $email = $request->input('email');

        Auth::user()->email = $email;
        Auth::user()->save();

        return redirect()->route('profile')->with('result', 'Profile updated successfully.');
    }

    public function getUserDiskQuota(Request $request) {
        $id = $request->input('userId');

        $user = User::find($id);

        $userQuota = $user->join('files', 'files.user_id' ,'=', 'users.id')
                            ->groupBy('disk_quota')
                            ->selectRaw('(sum(files.file_size) / 1024 / 1024) disk_usage, disk_quota')
                            ->get();

        return $userQuota->toJson();
    }
}
