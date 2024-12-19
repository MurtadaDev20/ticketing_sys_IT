<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Adminlogin(){
        $admin = Auth::guard('admin')->check();
        if($admin)
        {
            toastr()->warning('You Are alredy login');
            return redirect()->route('admin.dashboard');
        }
        return view('layouts.admin.auth.login');
    }
     // End method

     public function AdminDashboard(){
        return view('layouts.admin.dashboard');
    }

    // End method

    public function AdminloginSubmit(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();

        $data = [
            'email' => $check['email'],
            'password' => $check['password']
        ];

        if (Auth::guard('admin')->attempt($data)) {
            toastr()->success('Login Successfully');
            return redirect()->route('admin.dashboard');

        }else{
            toastr()->error('Invalide Creadentials');
            return redirect()->route('admin.login');

        }
    }

    // End method

     // End method

     public function AdminLogout(Request $request){

        Auth::guard('admin')->logout();
        toastr()->success('Logout Successfully');
        return redirect()->route('admin.login');

    }
    // End method
}
