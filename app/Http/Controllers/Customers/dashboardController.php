<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Admins; 
use App\Vendors; 
use App\Packages; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Redirect;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{

    public static $vendor;
    public static $user;

    
    public function publicCataloge()
    {	
        if(Auth::guard('customer')->check())
        {
            return view('customers.dashboard', ['user' => Self::get_user() , 'vendors'=>  Self::get_vendor() ]);
        } 
        return view('landing', [ 'vendors'=>  Self::get_vendor() ]);
    }
    
    public function index()
    {
        
		if(Auth::guard('customer')->check())
        {
            return view('customers.dashboard', ['user' => Self::get_user() , 'vendors'=>  Self::get_vendor() ]);
        } 
            return view('customers.landing');
       
    }

    public static function get_vendor() {
        $vendor = DB::table('packages')
        ->join('vendors', 'packages.vendor_uuid', '=', 'vendors.uuid')
        ->select('packages.*', 'vendors.*')
        ->get();
        Self::$vendor = $vendor;    
        return Self::$vendor;
    }

    public static function get_user() {
        $user = Auth::user(); 
        Self::$user = $user;    
        return Self::$user;
    }
	
  
}

