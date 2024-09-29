<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("users.index", [
            'users' => User::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $validated['password'] = Hash::make("password");

        User::create($validated);

        session()->flash('success', "User added successfully");
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $email_rules = $user->email == $request->email ? 'required|string|max:255|lowercase|email' : 'required|string|max:255|lowercase|email|unique:users';
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => $email_rules
        ]);

        $user->update($validated);

        session()->flash('success', "User updated successfully");
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('success', "User deleted successfully");
        return redirect(route('users.index'));
    }

    /**
     * Reset Password
     */
    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make("password")
        ]);

        session()->flash('success', "{$user->name}'s password reset to: \"password\"");
        return redirect(route('users.index'));
    }
}
