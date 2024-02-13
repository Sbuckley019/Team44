@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-row">
        <div class="dashboard-stat">
            <h3>Total Orders</h3>
            <p>123</p>
        </div>
        <div class="dashboard-stat">
            <h3>Total Sales</h3>
            <p>$4567</p>
        </div>
        <div class="dashboard-stat">
            <h3>Low Inventory</h3>
            <p>2 Products</p>
        </div>
        <div class="dashboard-stat">
            <h3>New Customers</h3>
            <p>5</p>
        </div>

        
        

    </div>
    
    <div class="dashboard-stat">

        <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
        </form>

    </div>    


    <!-- Add more dashboard rows as needed -->
</div>
@endsection