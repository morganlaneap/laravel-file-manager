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
}
