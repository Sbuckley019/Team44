<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //Gets all the customers, Stores them within the $customers variable
    //Navigates to the customerList page (*needs to be created)
    //When on the page use the $customers variable to display the list of customers
    public function index()
    {
        $customers = Customer::all();
        return view('customerList', compact('customers'));
    }

    public function create()
    {
        return view('signup');
    }

    //Creates and stores a customer
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
            'email' => 'email|unique:customers',
        ]);

        $hashed_password = bcrypt($request->password);

        Customer::create([
            'username' => $request->username,
            'password' => $hashed_password,
            'email' => $request->email
        ]);

        return redirect()->route('login')
            ->with('success', 'User created successfully');
    }

    public function show(Customer $customer)
    {
        return view('account', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('accountEdit', compact('customer'));
    }

    //Updates and stores a customer
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
        ]);

        $customer->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'address' => $customer->address,
            'phone_number' => $customer->phone_number

        ]);

        return redirect()->route('account')
            ->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request, Customer $customer)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $hashed_password = $request->password;

        $customer->update([
            'password' => $hashed_password,
        ]);

        return redirect()->route('account')
            ->with('success', 'Password updated successfully');
    }


    //Deletes a customer
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('home')
            ->with('success', 'Customer deleted successfully');
    }
}
