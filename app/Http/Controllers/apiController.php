<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Cookie;
use Session;
use Carbon\Carbon;

class apiController extends Controller
{
     

    public function apiLoad($id){
       
      
        $user = \DB::table('users')
                ->where('id', $id)
                ->get();
		$res = 'No records found';
        if($user){
				foreach($user as $key => $u){
				$res = $u->name;
			 }
			 
            return response($res, 200)
            ->header('APP_KEY','ejkgUo28WWwXgQzZb2JDr08rLg9tK3osEFsmSAFMkNAX5hdaCCVT1zefWym5')
            ->header('Content-Type','application/json');
		}
		 
        return response($res, 200)
        ->header('APP_KEY','ejkgUo28WWwXgQzZb2JDr08rLg9tK3osEFsmSAFMkNAX5hdaCCVT1zefWym5')
        ->header('Content-Type','application/json');

    }
    public function product(){
        $prod = \DB::table('reward_products')
                ->get();
        $res = [];
        foreach($prod as $key => $u){
            $res[$u->product_id ] = $u->product_name ;
         }
        return response()->json([
            'Products' => $res,
            'message' => 'Successfully created user!',
            'url' => route('api.product') . '?api_token=' . Auth::guard('api')->user()->api_token ,
        ], http_response_code())
        ->header('Content-Type','application/json')
        ->header('Authorization Bearer', Auth::guard('api')->user()->api_token);

    }

}
