<?php

namespace App\Traits;

use App\Models\support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

trait SupportManageTrait
{
    public function addsupport(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:supports,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $support = new support();
        $support->name = $validatedData['name'];
        $support->email = $validatedData['email'];
        $support->password = Hash::make($validatedData['password']);
        $support->photo = 'no_image.jpg';
        $support->save();
    }
}
