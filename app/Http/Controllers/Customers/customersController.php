<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Customers; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Redirect;
use Illuminate\Support\Facades\DB;

class customersController extends Controller
{
    public static $vendor;
    public static $user;

    public function index()
    {
		if(Auth::guard('customer')->check())
        {
            return view('customers.dashboard', ['user' => Self::get_user() , 'vendors'=>  Self::get_vendor() ]);
        } 
            return view('customers.landing');
       
    }
	public function login(Request $request){ 
      
        $data =	[
			'email'	=>	$request->get('email'),
			'password'	=>	$request->get('password')
        ];
       
        if(Auth::guard('customer')->attempt($data)) {

            return Redirect::route('customer.dashboard');           
        }
      
        return back()->withInput($request->only('email'));
        
    }
    public function create(){ 
		
        return view('customers.register'); 
         
    }
    
    protected function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $uuid = (string) Str::uuid();
        $res =  Customers::create([
            'uuid' =>  $uuid ,
            'name' => $request['name'],
            'email' => $request['email'],
            'is_live' => 'Y',
            'password' => Hash::make($request['password']),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        if($res){
            
            return view('customers.landing'); 
        }
        return view('customers.register'); 
    }
    public function logout(){
        \Session::flush();
        Auth::logout();
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

