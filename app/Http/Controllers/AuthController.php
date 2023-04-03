<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home')->with('success', 'Login successful!');
        }
        return redirect('login')->withError('Invalid Credentials');
    }

    public function register_view()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users|email',
        'password' => 'required|confirmed',
    ]);
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);
    Mail::to($user->email)->send(new WelcomeEmail($user));
    return redirect('login')->with('success', 'Registration Successful. Please Enter Your Email and password to login.');
}


    public function home()
    {
        return view('home');
    }

    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }
}
