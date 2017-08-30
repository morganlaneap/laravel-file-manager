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
        $showFooter = $request->has('showFooter');
        $footerMessage = $request->input('footerMessage');

        ConfigHelper::setValue('site_name', $siteName);
        ConfigHelper::setValue('show_footer_message', $showFooter);
        ConfigHelper::setValue('footer_message', $footerMessage);

        return redirect()->route('admin.settings')->with('result', 'Settings saved.');
    }
}
