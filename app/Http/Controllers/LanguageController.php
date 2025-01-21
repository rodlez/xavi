<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function change(Request $request)
    {
        $lang = $request->lang;

        if (!in_array($lang, ['en', 'es', 'ca'])) {
            abort(400);
        }

        Session::put('locale', $lang);

        // test update also app locale
        App::setLocale($lang);


        return redirect()->back();
    }
}
