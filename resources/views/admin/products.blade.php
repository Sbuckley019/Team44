<!-- resources/views/admin/products.blade.php -->
@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Manage Products</h2>
        <div class="container mt-4">
            @if (!empty($products))
                <div class="card">
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($products as $product)
                            <div class="card mb-3">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <img class="img-fluid ms-3" src="{{$product->image_url}}" alt="Product Image">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$product->product_name}}</h5>
                                            <p class="card-text">{{$product->description}}</p>
                                            <p class="card-text">Price: {{$product->price}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Quantity</h5>
                                            <p class="card-text">{{$product->stock_quantity}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body text-center">
                                            <button class="btn btn-primary btn-sm mb-1">Increase Stock</button>
                                            <button class="btn btn-secondary btn-sm mb-1">Edit Product</button>
                                            <button class="btn btn-danger btn-sm">Remove Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            @else
                <p>There are no Products currently.</p>
            @endif
        </div>
    </div>
</div>
@endsection