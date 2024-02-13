<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {

        \Log::info('Dashboard method accessed.');

        // Fetch analytics data, recent orders, inventory status, etc.
        $data = [
            // Your data here
        ];

        return view('admin.dashboard', compact('data'));
    }
    public function products()
    {
        return view('admin.products');
    }


    public function showSignupForm()
    {
        // Only show if there are no admins or by checking an invitation token
        return view('admin.signup');
    }




    public function login($username)
    {

        \Log::info('Authentication passed for user: ' . $username);
        return redirect()->route('admin.dashboard');
    }








    public function showLoginForm()
    {
        // Check if the admin is already logged in and redirect to dashboard if they are
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // If not logged in, show the login form
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('register');
    }
}
