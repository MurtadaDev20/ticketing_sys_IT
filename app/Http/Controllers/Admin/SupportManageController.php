<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Traits\SupportManageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupportManageController extends Controller
{
    use SupportManageTrait;
    public function index(Request $request)
    {
        $search = $request->input('search');

        $supports = Support::query()
        ->when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })
        ->paginate(10);
        return view('layouts.admin.backend.supportManage',compact('supports','search'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:supports,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $this->addsupport($request);
        toastr()->success('Add Support Successfully');
        return  redirect()->route('admin.support');
    }

    public function destroy($id)
    {
        $support = Support::findOrFail($id);
        $support->delete();
        toastr()->success('Delete Suport Successfully');
        return  redirect()->route('admin.support');
    }

    public function toggleStatus($id)
    {
        $support = Support::findOrFail($id);

        // Toggle the status
        $support->status = !$support->status;
        $support->save();

        // Display success message
        if ($support->status) {
            toastr()->success('Support has been enabled.');
        } else {
            toastr()->success('Support has been disabled.');
        }

        // Redirect to user management page
        return redirect()->route('admin.support');
    }

    //Update
    public function update(Request $request, $id)
    {
        $support = Support::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:supports,email,' . $support->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Update the support details
        $support->name = $request->name;
        $support->email = $request->email;

        // Only update the password if a new one was entered
        if ($request->filled('password')) {
            $support->password = Hash::make($request->password);
            $support->security_pass = '0';
        }

        $support->save();

        toastr()->success('Support updated successfully');
        return  redirect()->route('admin.support');
    }

}
