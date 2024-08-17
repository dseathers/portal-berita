<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{

    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan registrasi'
            ],422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => bcrypt($request->password)
        ]);

        if($user){
            return redirect()->route('login')->with('status', 'Registrasi berhasil, silakan login.');
        }

        return response()->json([
            'status' => false,
            'message' => 'Gagal melakukan registrasi'
        ],404);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email','password');

        // Menggunakan guard default 'web'
        if(!Auth::attempt($credentials)){
            return redirect()->route('login')->with('status', 'Email atau password salah');
        }


        // Redirect ke dashboard setelah login berhasil
        return redirect()->route('dashboard');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('login');
    }
}
