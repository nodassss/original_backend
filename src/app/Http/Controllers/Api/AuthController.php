<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
    
    public function me(Request $request)
    {
        
        
        $users = Auth::user();
        
        return $users;
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
        'message' => 'Invalid login details'
               ], 401);
        }
      
        $user = User::where('email', $request['email'])->firstOrFail();
        $users = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
      
        return response()->json([
               'access_token' => $token,
               'token_type' => 'Bearer',
               'user' => $users,
            ]);
    
    } 
    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
 
        $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
 
        $token = $user->createToken('auth_token')->plainTextToken;
 
        return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('token-name');
            return response()->json(['api_token' => $token->plainTextToken], 200);
        }

        return response()->json(['api_token' => null], 401);
    }
    
    // public function logout (Request $request) {
    //     auth('sanctum')->user()->tokens()->delete();
    //     return response(['message' => 'You have been successfully logged out.'], 200);
    // }

    // public function logout (Request $request) {
    //     Auth::guard('web')->logout();
    //     return response(['message' => 'You have been successfully logged out.'], 200);
    //     }

    //     Auth::guard('sanctum')->user()->tokens()->delete();
    //   $res = [];
    //   return response()->json($res, Response::HTTP_OK);
    //}
    /**
     * ログアウト
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $result = true;
        $status = 200;
        $message = 'ログアウトしました';
        return response()->json(['result' => $result, 'status' => $status, 'message' => $message]);
    }
}
    
