<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //Gets all the orders, Stores them within the $orders variable
    //Navigates to the 'list' view (list.blade.php needs to be created in order directory in views directory.)
    //When on the page use the $orders variable to display the orders

    public function index()
    {
        $orders = Order::all();
        return view('order.list', compact('orders'));
    }

    // Display the specified order
    // 'show' view needs to be created

    public function show(Order $order)
    {
        return view('orders', compact('order'));
    }


    public function addOrder(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $order = Order::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'total_price' => $request->total_price,
                    'status' => 'pending'
                ],
            );

            return redirect()->route('order.index');
        } else {
            return redirect()->route('register');
        }
    }


    //   public function create()
    //   {
    //   // 'create' view needs to be created 
    //   return view('order.create');
    //   }


    // Check if the authenticated user has permission to create orders
    // Validate the request data
    // Create a new order in the database
    // Redirect with a success message

    /*    public function store(Request $request)
    {
        if (!Auth::user()->can('create', Order::class)) {
            return redirect()->route('order.index')->with('error', 'Unauthorized to create orders');
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
          
        ]);
    
        Order::create([
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);
    
        return redirect()->route('order.index')->with('success', 'Order created successfully');
    }

  */

    /*
    // Check if the authenticated user is the owner of the order  
    // Show the form for editing the specified order 
    // 'edit' view needs to be created)
   
    public function edit(Order $order)
    {
       
    
        return view('order.edit', compact('order'));
    }
  */

    /*
  // Update the specified order in the database
    public function update(Request $request, Order $order)

    {
         // Check if the authenticated user is the owner of the order
        if (!Auth::user()->can('update', $order)) {
            return redirect()->route('order.index')->with('error', 'Unauthorized to update this order');
        }

        // Validate the request data
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Update the order in the database
        $order->update([
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);

        // Redirect with a success message
        return redirect()->route('order.index')->with('success', 'Order updated successfully');
    }
   */

    /* 
   // Remove the specified order from the database
    public function destroy(Order $order)
    {

        // Check if the authenticated user is the owner of the order
        if (!Auth::user()->can('delete', $order)) {
            return redirect()->route('order.index')->with('error', 'Unauthorized to delete this order');
        }

        $order->delete();

        // Redirect with a success message
        return redirect()->route('order.index')->with('success', 'Order deleted successfully');
  
    }
*/
}
