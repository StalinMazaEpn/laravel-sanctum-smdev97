<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Register an user and get a bearer token
    public function register(Request $request){
        //Validate Data
        $requestData = $request->json()->all();
        //dd($requestData, gettype ($requestData));
        $validator = Validator::make($requestData, [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8"
        ]);
        if($validator->fails()){
            return response()->json([
                'status'   => 'ERROR',
                'message'  => $validator->getMessageBag()
            ],400);
        }

//        dd($validateData);
        //Create an user
        $user = User::create([
            "name" => $requestData["name"],
            "email" => $requestData["email"],
            "password" => Hash::make($requestData["password"])
        ]);
        //Create Token
        $token = $user->createToken("auth_token")->plainTextToken;

        //Return Data
        return response()->json([
            "access_token" => $token,
            "token_type" => "Bearer"
        ]);
    }

    //Log In an User and get a bearer token
    public function login(Request $request){
        $request_data = $request->json()->all();
        $validator = Validator::make($request_data, [
            "email" => "required|string|email|max:255",
            "password" => "required|string"
        ]);
        if($validator->fails()){
            return response()->json([
                'status'   => 'ERROR',
                'message'  => $validator->getMessageBag()
            ],400);
        }
        $check_login_data = ['email' => $request_data["email"], 'password' => $request_data["password"]];
        $loginCorrect = Auth::attempt($check_login_data);
        //dd($loginCorrect);
        if(!$loginCorrect){
            return response()->json([
                'status'   => 'ERROR',
                'message'  => 'Invalid Login'
            ],400);
        }
        try {
            $user = User::where("email", $request_data["email"])->firstOrFail();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => 'ERROR',
                'error' => '404 not found resource expected'
            ], 404);
        }
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "access_token" => $token,
            "token_type" => "Bearer"
        ]);
    }

    public function profileUser(Request $request){
        return $request->user();
    }
}
