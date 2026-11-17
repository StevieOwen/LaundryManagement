<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Actions\Fortify\PasswordValidationRules;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function handleLogin(Request $request){
        $credentials=$request->validate([
            'email'=>['required','string','email','max:255'],
            'password'=>['required','string','max:255'],
        ]);

        if (Auth::attempt($credentials)) {
        // Regenerate the session to prevent session fixation attacks
        $request->session()->regenerate();

        // Get the currently authenticated user
        $user = Auth::user();

        // Redirect based on the user's role
        return match ($user->role) {
            'admin' => redirect()->intended('admin/'),
            'employee' => redirect()->intended('employee/dashboard'),
            default => redirect()->intended('employee/dashboard'),
        };

        }
        // 3. If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function logout(){
        auth()->logout();
        return view('auth.login');
    }


    

    

    
}
