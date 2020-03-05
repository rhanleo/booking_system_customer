<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Customers;
use App\Basket; 
use App\Vendors; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Redirect;
use Illuminate\Support\Facades\DB;

class basketController extends Controller
{
    public static $vendor;
    public static $user;

    public function index()
    {
        $baskets = DB::table('basket')
        ->join('customers', 'basket.customer_uuid', '=', 'customers.uuid')
        ->join('vendors', 'basket.vendor_uuid', '=', 'vendors.uuid')
        ->select('basket.*', 'customers.*', 'vendors.*')        
        ->where('basket.customer_uuid', Auth::user()->uuid)
        ->get();

        $total = DB::table('basket')
        ->join('customers', 'basket.customer_uuid', '=', 'customers.uuid')
        ->join('vendors', 'basket.vendor_uuid', '=', 'vendors.uuid')
        ->select( DB::raw('SUM(basket.package_rates) as total_rates'))
        ->where('basket.customer_uuid', Auth::user()->uuid)
        ->get()->first();
        
        return view('customers.basket.index', ['baskets'=>  $baskets, 'total' => $total ]);      
       
    }

    public function remove($uuid){ 
        $res =  Basket::where('basket_uuid', $uuid)
            ->delete();
            if($res > 0){
                $msg = 'Successfully Removed!';
            } else{
                $msg = 'Error !';
            }
        return Redirect::route('customer.basket')
        ->with('success', $msg); 
         
    }
    
    protected function addToBasket(Request $request)
    {
        $uuid = (string) Str::uuid();
        $now = date('Y-m-d h:i:s');
        // dd($request);
        $res =  Basket::create([
            'basket_uuid' =>  $uuid,
            'customer_uuid' =>  Auth::user()->uuid,
            'package_uuid' => $request['package_uuid'],
            'vendor_uuid' => $request['vendor_uuid'],
            'package_quantities' => $request['quantity'],
            'package_rates' => $request['rates'],
            'package_rates_total' => $request['rates'],
            'created_at' =>  $now,
            'updated_at' =>  $now,
        ]);
        if($res) {
            $msg = 'Successfully Updated!';
        } else{
            $msg = 'Error !';
        }
        return Redirect::route('customer.basket')->with('success')->with('success', $msg); 
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

