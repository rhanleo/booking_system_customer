<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		if(Auth::guard('web')->check())
        {
            return view('dashboard');
        }else{
                                   
            return view('landing');
        }
       
    }
	public function dashboard()
    {                        
        return view('dashboard');
    }
}
