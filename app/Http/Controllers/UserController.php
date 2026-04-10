<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'User';
        $users = User::latest()->paginate(9);
        return view("dashboard.user.index", compact("users", "title"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $title = 'Create User';
        return view('dashboard.user.create', compact('title', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => 'required|min:2|string|max:255|unique:users',
            'slug' => 'required|string|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        $validate['password'] = bcrypt($validate['password']);
        $user::create($validate);
        return redirect('/dashboard/user')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Edit User';
        return view('dashboard.user.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'=> 'required|min:2|string|max:255|',
            'password' => 'required|string|min:6|',
            'email'=> 'required',
            'role' => 'required|string|max:255',];
        if (request('slug') != $user->slug){
            $rules['slug'] = 'required|unique:users';
            
        }

        if (request('username') != $user->username){
            $rules['username'] = 'required|unique:users';
        }

        if (request('email') != $user->email){
            $rules['email'] = 'required|email|unique:users';
        }



        $validate = $request->validate($rules);
        $user->update($validate);
        return redirect('/dashboard/user')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/dashboard/user')->with('success', 'User deleted successfully.');
    }
}
