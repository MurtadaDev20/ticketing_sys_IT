<?php

namespace App\Traits;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

trait UserManageTrait
{
    public function adduser(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:supports,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->photo = 'no_image.jpg';
        $user->save();
    }
}
