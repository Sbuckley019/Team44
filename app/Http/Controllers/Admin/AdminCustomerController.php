<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;


class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = User::all();

        $customers->transform(function ($customer) {
            return [
                'id' => $customer->id,
                'username' => $customer->username,
                'email' => $customer->email,
                'spent' => 1,
                'date' => $customer->created_at->toDateString(),
            ];
        });


        return Inertia::render('Admin/Customers', ['customers' => $customers]);
    }
}
