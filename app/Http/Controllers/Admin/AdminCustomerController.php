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
        $customers = User::with('orders')->get();

        $customers->transform(function ($customer) {
            $totalSpent = $customer->orders->sum('total_price');

            return [
                'id' => $customer->id,
                'username' => $customer->username,
                'email' => $customer->email,
                'spent' => $totalSpent,
                'date' => $customer->created_at->toDateString(),
            ];
        });

        return Inertia::render('Admin/Customers', ['customers' => $customers]);
    }
}
