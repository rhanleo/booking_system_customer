<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Customers;
use App\Basket; 
use App\Vendors; 
use App\Orders; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Redirect;
use Illuminate\Support\Facades\DB;

class checkoutController extends Controller
{
    public static $vendor;
    public static $user;

    public function index($uuid)
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
        if(count($baskets ) < 1){
            return back()->with('error', 'No item found. Go to shop now!');
        }

        return view('customers.checkout.index', ['baskets'=>  $baskets, 'total' => $total, $uuid ]);      
       
    }

    protected function successMsg($uuid)
    {
        
        $baskets = DB::table('basket')
        ->join('customers', 'basket.customer_uuid', '=', 'customers.uuid')
        ->join('vendors', 'basket.vendor_uuid', '=', 'vendors.uuid')
        ->select('basket.*', 'customers.*', 'vendors.*')
        ->where('basket.customer_uuid', Auth::user()->uuid)
        ->get();
        
        if(count($baskets) > 0){
            foreach($baskets as $basket){
                $uuid = (string) Str::uuid();
                Orders::create([
                    'order_uuid' =>  $uuid,
                    'customer_uuid' =>  Auth::user()->uuid,
                    'vendor_uuid' =>  $basket->vendor_uuid,
                    'payment_method' =>  'Paypal',
                    'billing_name' => Auth::user()->name,
                    'billing_email' => Auth::user()->email,
                    'billing_address' => 'Test Address',
                    'order_quantities' => '1',
                    'order_status' => 'Delivered',
                    'order_amount' => $basket->package_rates,
                    
                    'created_at' =>  date('Y-m-d h:i:s'),
                    'updated_at' =>  date('Y-m-d h:i:s'),
                ]);
            }
        }
        // dd(Auth::user()->uuid);
        $res = Basket::where('customer_uuid', Auth::user()->uuid)
        ->delete();
         
        
    return view('customers.checkout.success');  
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

