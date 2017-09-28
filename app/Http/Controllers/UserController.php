<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Helpers\QuotaHelper;

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

        $userQuota = QuotaHelper::getUserQuotaUsed($id);

        return $userQuota->toJson();
    }
}
