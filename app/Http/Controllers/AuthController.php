<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AuthController;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;
use PDF;


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
    // public function register_view($from_admin = false)
    // {
    //     if ($from_admin) {
    //         session(['register_from_admin' => true]);
    //     } else {
    //         session()->forget('register_from_admin');
    //     }
    //     return view('auth.register', ['from_admin' => $from_admin]);
    // }
    


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
{
    $users = User::paginate(4); // paginated query

    return view('admin.dashboard', compact('users'));
}

        $users = User::all();
    }

    public function home()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    public function makeAdmin(User $user)
    {
        $user->is_admin = true;
        $user->save();
    
        return redirect()->back()->with('success', 'User has been made an admin!');
    }
    public function exportPDF()
    {
       $users = User::all();
       $pdf = PDF::loadView('admin.export-pdf', compact('users'));
       return $pdf->download('admin-data.pdf');
   }
   public function deleteUser(Request $request, $id)
   {
       $user = User::find($id);
       if ($user) {
           $user->delete();
           return redirect()->back()->with('success', 'User has been deleted!');
       } else {
           return redirect()->back()->with('error', 'User not found.');
       }
   }
   



    
    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }
}
