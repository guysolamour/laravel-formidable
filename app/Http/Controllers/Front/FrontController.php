<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class FrontController extends BaseController
{
    public function home()
    {
       $page = get_meta_page('home');

       return view('front.home.index', compact('page'));
    }

    public function about()
    {
       $page = get_meta_page('about');

       return view('front.about.index', compact('page'));
    }

    public function legalMentions()
    {
       $page = get_meta_page('legalmention');

       return view('front.legalmention.index', compact('page'));
    }
}
