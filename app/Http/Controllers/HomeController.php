<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use Illuminate\Support\Facades\DB;

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
        // $users = User::all(); //Eloquent ORM
        $users = DB::table('users')->get();
        return view('home', compact('users'));
    }
}