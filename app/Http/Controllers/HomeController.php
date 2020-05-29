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
        $path = storage_path('app/uploaded/' . Auth()->user()->id);
        $files = is_dir($path)
            ? array_filter(
                scandir($path),
                function ($v) {
                    return $v != '.' && $v != '..';
                }
            )
            : [];
        return view('home', [ 'files' => $files ]);
    }
}
