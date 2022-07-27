<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Scroll;
use App\Models\Sound;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
   
    public function show_translate()
    {
        $language = session()->get('lang');

        return view('dashboard.languages.language_view_en', compact('language'));
    }
    public function changeLanguage(Request $request, $language)
    {
        // dd($language);
        $status = in_array($language, ['ar', 'en']);
        $lang = $status ? $language : 'ar';
        App::setLocale($lang);
        $request->session()->put('lang', $lang);
        // dd(session()->get('lang') . ' CURRENT: ' . App::currentLocale());
        return redirect()->back();
    }
    public function key_value_store(Request $request)
    {


        $data = openJSONFile($request->id);

        foreach ($request->key as $key => $key) {
            $data[$key] = $request->key[$key];
        }
        saveJSONFile($request->id, $data);
        return back();
    }
}
