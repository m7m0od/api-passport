<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class apiAuthController extends Controller
{
    
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:50|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = Role::where('name','user')->first()->id;

        $user = User::create($data);

        $token = $user->createToken('apiToken')->accessToken; 
        
        return response(['user' => $user,'token' => $token]);

        //return redirect(url('/login'));
        
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. 
            Please try again']);
        }

        $token = auth()->user()->createToken('apiToken')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);

    }

    public function logout(Request $request)
    {
        if ($request->user()) { 
            $request->user()->tokens()->delete();
        }
        return response()->json(['message' => 'loged out'], 200);
    }
}
