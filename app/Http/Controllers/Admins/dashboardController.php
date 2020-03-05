<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Admins; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Redirect;

class dashboardController extends Controller
{


    public function index()
    {
    //    dd(Auth::user());
		if(Auth::guard('admin')->check())
        {
            
            $admin = Admins::select('name')->first();

            return view('admins.dashboard', ['user' => $admin]);
        } 
        
            return view('customers.landing');
    
       
    }
	
  
}

