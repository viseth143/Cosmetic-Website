<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Check admin (users table)
        $user = \App\Models\User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('is_admin', true);
            Session::put('admin_name', $user->name);
            return redirect()->route('admin.dashboard');
        }

        // Check customer
        $customer = Customer::where('email', $request->email)->first();
        if ($customer && Hash::check($request->password, $customer->password_hash)) {
            Session::put('customer_id', $customer->customer_id);
            Session::put('customer_name', $customer->customer_name);
            Session::put('is_admin', false);
            return redirect()->route('home');
        }

        return back()->with('error', 'Invalid email or password.')->withInput();
    }

    // Show register page
    public function showRegister()
    {
        return view('register');
    }

    // Handle register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customer,email',
            'password' => 'required|min:6',
            'phone'    => 'required',
        ]);

        Customer::create([
            'customer_name' => $request->name,
            'email'         => $request->email,
            'password_hash' => Hash::make($request->password),
            'phone'         => $request->phone,
        ]);

        return redirect()->route('login')->with('success', '✅ Account created! Please login.');
    }

    // Logout
    public function logout()
    {
        Session::forget(['customer_id', 'customer_name', 'is_admin', 'admin_name']);
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}