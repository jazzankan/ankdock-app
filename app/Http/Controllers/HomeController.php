<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

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
        $anders = User::where('id', 1)->first();
        //dd($firstuser);
        $visitingnumber = file_get_contents("../counter.txt");
        return view('dashboard')->with('anders',$anders)->with('visitingnumber',$visitingnumber);
    }
}
