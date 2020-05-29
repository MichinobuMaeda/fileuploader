<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $files = array_filter(
            scandir(storage_path('app/uploaded/' . Auth()->user()->id)),
            function ($v) {
                return $v != '.' && $v != '..';
            }
        );
        return view('home', [ 'files' => $files ]);
    }
}
