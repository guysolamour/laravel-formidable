<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    public function redirectTo()
    {
        return config('administrable.auth_prefix_path');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        return view('back.dashboard.index');
    }

}
