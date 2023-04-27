<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // return user view
    public function index()
    {
        $departments = Department::get();
        $roles = UserRole::get();
        $users = User::get();

        return view('user')->with(['users' => $users, 'roles' => $roles, 'departments' => $departments]);
    }

    // store user
    public function store(Request $request)
    {

        $request->validate([
            'register_name' => 'required|max:100',
            'register_username' => 'required|unique:users,username',
            'register_department' => 'required',
            'register_role' => 'required',
            'register_email' => 'required|email|unique:users,email',
            'register_password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->input('register_name'),
            'username' => $request->input('register_username'),
            'department_id' => $request->input('register_department'),
            'role_id' => $request->input('register_role'),
            'email' => $request->input('register_email'),
            'password' => Hash::make($request->input('register_password')),
        ]);

        return back()->with('success', 'Successfully registered user !');
    }

    // edit user : opens up the update form
    public function edit()
    {
        $departments = Department::get();
        $roles = UserRole::get();
        $user = User::find(request('user'));

        return view('user-edit')->with(['user' => $user, 'roles' => $roles, 'departments' => $departments]);
    }

    // update user
    public function update(Request $request)
    {

        $user = User::find($request->input('user_id'));

        $request->validate([
            'update_name' => 'required|max:100',
            'update_department' => 'required',
            'update_role' => 'required',
            'update_email' => 'nullable|email|unique:users,email,' . $user->id,
            'update_username' => 'required|max:100|unique:users,username,' . $user->id,
        ]);

        // update model information
        $user->name = $request->input('update_name');
        $user->department_id = $request->input('update_department');
        $user->role_id = $request->input('update_role');
        $user->email = $request->input('update_email');
        $user->username = $request->input('update_username');

        // save model details to database
        $user->save();

        return back()->with('success', 'Successfully updated user !');
    }

    // delete user
    public function delete(Request $request)
    {
        User::find($request->input('user_id'))->delete();
        return back()->with('success', 'Successfully deleted user !');
    }
}
