<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{

    public function login(LoginRequest $request)
    {

        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ];
        $user = User::where(['username' => $request->username, 'password' => Hash::make($request->password)])->get();
        return $user;
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return ['message' =>'logged out'];
    }


}
