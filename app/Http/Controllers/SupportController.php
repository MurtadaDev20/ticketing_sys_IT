<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SupportController extends Controller
{
    public function supportlogin(){
        $support = Auth::guard('support')->check();
        if($support)
        {
            toastr()->warning('You Are alredy login');
            return redirect()->route('support.main');
        }
        return view('layouts.support.auth.login');
    }
     // End method

     public function SupportMain(){
        return view('layouts.support.welcome');
    }

    // End method

    public function supportloginSubmit(Request $request){


                $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);

                $check = $request->all();

                $data = [
                    'email' => $check['email'],
                    'password' => $check['password']
                ];

                if (Auth::guard('support')->attempt($data)) {
                    if(Auth::guard('support')->user()->security_pass == 0)
                    {
                        return redirect()->route('support.securityPasswordView');
                    }
                    return redirect()->route('support.main');

                }else{
                    toastr()->error('Invalide Creadentials');
                    return redirect()->route('support.login');

                }

    }

    // End method

    public function securityPasswordView()
    {
        return view('layouts.support.auth.securityPassword');
    }

    public function securityPassword(Request $request)
    {

            $supportAuth = Auth::guard('support')->user();
            $validatedData = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $supportUser = Support::where('id',$supportAuth->id);
            $supportUser->update([
                'password' => Hash::make($validatedData['password']),
                'security_pass' =>'1'
            ]);

            Auth::guard('support')->logout();
            toastr()->success('Password Updated');
            return redirect()->route('support.login');
    }


     public function supportLogout(){

        Auth::guard('support')->logout();
        return redirect()->route('support.login');

    }
    // End method
}
