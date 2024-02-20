<!-- resources/views/admin/products.blade.php -->
@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Manage Orders</h2>
        <div class="container mt-4">
            @if (!empty($orders))
                <div class="card">
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($orders as $order)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Order #{{ $order->id }}</h5>
                                    <p class="card-text">Placed on {{ $order->created_at->format('d M Y') }}</p>
                                    <p class="card-text">Total Cost: ${{ number_format($order->total_price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            @else
                <p>There are no Orders to be Processed</p>
            @endif
        </div>
    </div>
</div>
@endsection