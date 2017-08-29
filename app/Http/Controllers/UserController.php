<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
}
