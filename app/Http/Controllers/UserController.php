<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\BasketController;

class UserController extends Controller
{
    //Gets all the Users, Stores them within the $Users variable
    //Navigates to the UserList page (*needs to be created)
    //When on the page use the $Users variable to display the list of Users
    public function index()
    {
        $users = User::all();
        return view('UserList', compact('users'));
    }

    public function create()
    {
        return view('Register');
    }

    //Creates and stores a User
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:4|confirmed',
            'email' => 'email|unique:Users',
        ]);

        $hashed_password = bcrypt($request->password);

        User::create([
            'username' => $request->username,
            'password' => $hashed_password,
            'email' => $request->email
        ]);

        return redirect()->route('home')
            ->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        return view('account', compact('user'));
    }

    public function edit(User $user)
    {
        return view('accountEdit', compact('user'));
    }

    //Updates and stores a User
    /*
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:Users,email,' . $user->id,
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'address' => $user->address,
            'phone_number' => $user->phone_number

        ]);

        return redirect()->route('account')
            ->with('success', 'Profile updated successfully');
    }
    */

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            $user = Auth::user();

            /** @var \App\Models\User $user */
            $user->update([
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('home')
                ->with('success', 'Password updated successfully');
        } catch (QueryException $exception) {
            // Log the error or handle it in a way that makes sense for your application
            return redirect()->route('home')->with('error', 'An error occurred while adding the product.' . $exception->getMessage());
        }
    }


    //Deletes a User
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('home')
            ->with('success', 'User deleted successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $basketcontroller = new BasketController();
            $basketcontroller->guestToUser();

            return redirect()->route('home')
                ->with('success', 'Login successful');
        } else if (Auth::guard('admin')->attempt($credentials)) {
            $admin = new AdminController();
            $response = $admin->login($request->username);
            return $response;
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home')->with('success', 'Successfully logged out');
    }
}
