<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AuthController;

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
            if (auth()->user()->is_admin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            } else {
                return redirect('home')->with('success', 'Login successful!');
            }
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
        'is_admin' => 0,
    ]);
    Mail::to($user->email)->send(new WelcomeEmail($user));
    return redirect('login')->with('success', 'Registration Successful. Please Enter Your Email and password to login.');
}
    public function adminDashboard()
  {
    return view('admin.dashboard');
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