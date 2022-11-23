<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'nama_user' => 'required',
            'umur' => 'required',
            'no_handphone' => 'required',
            'alamat' => 'required',
        ]);
    
        $user = User::create([
            'nama_user' => $fields['nama_user'],
            'umur' => $fields['umur'],
            'no_handphone' => $fields['no_handphone'],
            'alamat' => $fields['alamat'],
        ]);
    
        $token = $user->createToken('tokenku')->plainTextToken;
    
        $response = [
            'user' => $user,
            "token" => $token
        ];
    
        return response($response, 201);
    }
    
    public function login(Request $request)
    {
        $fields = $request->validate([
            'nama_user' => 'required|string',
            'no_handphone' => 'required|string',
        ]);
    
        // Check Email
        $user = User::where('nama_user',$fields['nama_user'])->first();
    
        // Check Password
        if (!$user ){
        return response([
            'message' => 'unauthorized'
        ],401);
    }
    
    $token = $user->createToken('tokenku')->plainTextToken;
    
    $response = [
        'user' => $user,
        'token' => $token
    ];
    
    return response($response, 201);
    }
    
    public function logout(Request $request)
    {
        // return $request->user();
        $request->user()->currentAccessToken()->delete();
    
        return [
            'message' => 'Logged out'
        ];
    }
}