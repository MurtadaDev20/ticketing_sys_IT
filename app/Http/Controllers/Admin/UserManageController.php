<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\User;
use App\Traits\UserManageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class UserManageController extends Controller
{
    use UserManageTrait;
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
        ->when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        return view('layouts.admin.backend.userManage',compact('users','search'));
    }
//store
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $this->adduser($request);
        toastr()->success('Add Users Successfully');
        return  redirect()->route('admin.user');
    }
//Destroy
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toastr()->success('Delete User Successfully');
        return  redirect()->route('admin.user');
    }
//ToggleStatus
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Toggle the status
        $user->status = !$user->status;
        $user->save();

        // Display success message
        if ($user->status) {
            toastr()->success('User has been enabled.');
        } else {
            toastr()->success('User has been disabled.');
        }

        // Redirect to user management page
        return redirect()->route('admin.user');
    }
//Update
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Update the user details
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update the password if a new one was entered
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->security_pass = '0';
        }

        $user->save();

        toastr()->success('User updated successfully');
        return  redirect()->route('admin.user');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'file' => 'required|max:2048',
    ]);

    try {
        Excel::import(new UsersImport, $request->file('file'));
        toastr()->success('Users imported successfully.');
    } catch (ValidationException $e) {
        $failures = $e->failures();

        foreach ($failures as $failure) {
            $row = $failure->row(); // row that went wrong
            $attribute = $failure->attribute(); // the field name that had the error
            $errors = $failure->errors(); // array of errors
            toastr()->error("Row $row: ".implode(', ', $errors));
        }
    } catch (\Exception $e) {
        toastr()->error('An error occurred: ' . $e->getMessage());
    }

    return back();
}
}
