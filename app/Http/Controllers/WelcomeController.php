<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome() {

        // $temasTodos = DB::select('SELECT * FROM themes');
        // $temasTodos = DB::table('themes')->get();

        // $temasTodos = Theme::all();

        $temasDestacados = Theme::where('destacado', 1)->with('articles.imagenes')->orderBy('id','desc')->get();
        return view('welcome')->with(compact('temasDestacados'));

    }
}
