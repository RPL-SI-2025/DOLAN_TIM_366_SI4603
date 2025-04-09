<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email:dns|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'First_Name' => $request->firstName,
            'Last_Name' => $request->lastName,
            'role' => 'user',
            'enterprise' => null,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'subcription' => null,
        ]);

        $request->session()->put('success', 'Registration success!');

        return redirect('/');
    }
}