<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConfigHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index() {
        return view('admin.settings');
    }

    public function saveSettings(Request $request) {
        $siteName = $request->input('siteName');

        ConfigHelper::setValue('site_name', $siteName);

        return redirect()->route('admin.settings')->with('result', 'Settings saved.');
    }
}
