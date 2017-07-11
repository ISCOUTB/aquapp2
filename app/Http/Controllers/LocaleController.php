<?php

namespace App\Http\Controllers;

use Config;
use Session;

class LocaleController extends Controller
{
    public function switchLanguage($locale)
    {
        if (array_key_exists($locale, Config::get('locale'))) {
            Session::put('applocale', $locale);
        }

        return back();
    }
}
