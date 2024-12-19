<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userlogin(){
        $user = Auth::check();
        if($user)
        {
            toastr()->warning('You Are alredy login');
            return redirect()->route('user.main');
        }
        return view('layouts.user.auth.login');
    }
     // End method

     public function userMain(){
        return view('layouts.user.welcome');
    }

    // End method

    public function userloginSubmit(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();

        $data = [
            'email' => $check['email'],
            'password' => $check['password']
        ];

        if (Auth::attempt($data)) {
            if(Auth::user()->security_pass == 0)
                    {
                        return redirect()->route('user.securityPasswordView');
                    }
            return redirect()->route('user.main');

        }else{
            toastr()->error('Invalide Creadentials');
            return redirect()->route('user.login');

        }
    }

    // End method

    public function securityPasswordView()
    {
        return view('layouts.user.auth.securityPassword');
    }

    public function securityPassword(Request $request)
    {
        if(Auth::user()){
            $userAuth = Auth::user();
            $validatedData = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $User = User::where('id',$userAuth->id);
            $User->update([
                'password' => Hash::make($validatedData['password']),
                'security_pass' =>'1'
            ]);

            Auth::logout();
            toastr()->success('Password Updated');
            return redirect()->route('user.login');
        }else{
            toastr()->error('Your session has been expired');
            return redirect()->route('user.login');
        }
    }

     public function userLogout(Request $request){

        Auth::logout();
        toastr()->success('Logout Successfully');
        return redirect()->route('user.login');

    }
    // End method
}
