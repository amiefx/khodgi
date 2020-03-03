<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'=> 'required|max:55',
            'email'=> 'email|required|unique:users',
            'password'=> 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=> $user, 'access_token'=> $accessToken]);
    }

    public function login(Request $request)
   {
       //echo json_encode($request->all());exit;
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $admin = null;

        if(auth()->attempt($loginData)) {
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
             $admin = Auth::user()->isAdmin();
             return response(['user' => auth()->user(), 'access_token' => $accessToken, 'isAdmin' => $admin], 200);
           // return response(['user' => auth()->user(), 'access_token' => $accessToken], 200);
        }

        return response()->json(['status'=>'Invalid credentials'], 403);
   }

   public function verify(Request $request) {
       return $request->user()->only('name', 'email');
   }
}
