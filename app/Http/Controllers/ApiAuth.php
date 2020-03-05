<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
class ApiAuth extends Controller
{
    //
	public $successStatus = 200;

	public function login(Request $request){ 
		$creds = $request->only('email','password');
     
		config(['app.timezone' => 'Asia/Singapore']);
        if(Auth::attempt($creds)){ 
            $user = Auth::user(); 
            $objToken = $user->createToken('tx2');
            $success['token'] =  $objToken->accessToken;
	        $success['expires'] = $objToken->token->expires_at; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
	 public static function user($id){
       
      
        $user = \DB::table('users')
                ->select('id','name', 'email','username','is_admin', 'created_at')
                ->where('id', $id)
                ->get();
				 
        return response($user, 200)
        ->header('APP_KEY','ejkgUo28WWwXgQzZb2JDr08rLg9tK3osEFsmSAFMkNAX5hdaCCVT1zefWym5')
        ->header('Content-Type','application/json');

    }
    public static function users(){
       
      
        $user = \DB::table('users')
                ->select('id','name', 'email','username','is_admin', 'created_at')
                ->get();
				 
        return response($user, 200)
        ->header('APP_KEY','ejkgUo28WWwXgQzZb2JDr08rLg9tK3osEFsmSAFMkNAX5hdaCCVT1zefWym5')
        ->header('Content-Type','application/json');

    }
	
	public function signup(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
			'is_admin' => $request->is_admin,
			'is_live' => 'Y',
			'api_token' => Str::random(60),
            'password' => Hash::make($request->password)
        ]);
        $user->save();
          
        $objToken = $user->createToken('tx2');
        $success['token'] =  $objToken->accessToken;
	    $success['expires'] = $objToken->token->expires_at;
        return response()->json(['success' => $success], $this-> successStatus);    
    }
  
}

