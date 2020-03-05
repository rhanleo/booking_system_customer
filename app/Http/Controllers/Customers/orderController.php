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

class orderController extends Controller
{
    public static $vendor;
    public static $user;

    public function index()
    {
        $orders = DB::table('orders')
        ->join('customers', 'orders.customer_uuid', '=', 'customers.uuid')
        ->join('vendors', 'orders.vendor_uuid', '=', 'vendors.uuid')
        ->select('orders.*', 'customers.*', 'vendors.*')        
        ->where('orders.customer_uuid', Auth::user()->uuid)
        ->get();

        $total = DB::table('orders')
        ->join('customers', 'orders.customer_uuid', '=', 'customers.uuid')
        ->join('vendors', 'orders.vendor_uuid', '=', 'vendors.uuid')
        ->select( DB::raw('SUM(orders.order_amount) as total_amount'))
        ->where('orders.customer_uuid', Auth::user()->uuid)
        ->get()->first();
        // dd($orders);
        return view('customers.orders.index', ['orders'=>  $orders, 'total' => $total ]);      
       
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

