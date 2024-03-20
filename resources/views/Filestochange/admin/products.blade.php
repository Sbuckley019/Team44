@extends('admin.layout')

@section('title', 'Products Management')

@section('content')
<style>
    .admin-content {
        width: 100%;
        padding: 15px;
        margin: auto;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .admin-body {
        display: flex;
        align-items: flex-start;
        margin-right: 20px;
    }

    .admin-button {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border: 1px solid #007bff;
        margin-bottom: 10px;
    }

    .admin-section {
        background-color: #fff;
        padding: 20px;
        margin-top: 20px;
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .admin-section-header {
        font-size: 1.2em;
        margin-bottom: 5px;
    }

    .admin-actions {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
    }

    .edit-button {
        background-color: #ffc107;
        margin-bottom: 10px;
    }

    .remove-button {
        background-color: #dc3545;
    }

    .product-image {
        width: 100px;
        height: auto;
        margin-right: 20px;
        /* margin-bottom: 10px; */
        border-radius: 0.25rem;
    }

    
    .product-details {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    

    .product-description,
    .product-price,
    .product-quantity {
        margin-bottom: 5px;
    }

    .product-price,
    .product-quantity {
        font-weight: bold;
    }

    .admin-form-inline {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .admin-form-group {
        display: flex;
        align-items: center;
    }

    .admin-input,
    .admin-select {
        display: block;
        width: auto;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        margin-left: 10px;
    }

    @media (max-width: 768px) {
        .admin-form-inline {
            flex-direction: column;
        }

        .admin-form-group {
            width: 100%;
        }

        .admin-input,
        .admin-select {
            width: 100%;
            margin: 5px 0;
        }

        .admin-body {
            flex-direction: column;
            align-items: center;
        }

        .admin-actions {
            width: 100%;
            align-items: center;
        }

        .product-details {
        align-items: center;
        }


    }
</style>

<div class="admin-content">
    <div class="admin-header">
        <h2>Manage Products</h2>
        <a href="{{ route('products.create') }}" class="admin-button">Add New Product</a>
    </div>

    

 <!-- Filtering Form -->
    <div class="admin-section">
        <div class="admin-section-header">Filter Products</div>
        <form action="{{ route('products.adminIndex') }}" method="GET" class="admin-form-inline">
            <div class="admin-form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" class="admin-select">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="admin-form-group">
                <label for="priceRange">Price Range:</label>
                <input type="text" id="priceRange" name="priceRange" placeholder="Min - Max" class="admin-input">
            </div>
            <button type="submit" class="admin-button admin-button-inline">Filter</button>
        </form>
    </div>



    @if (!empty($products))
        @foreach ($products as $product)
            <div class="admin-section">
            
                <div class="admin-section-header">{{$product->product_name}}</div>
                
                <div class="admin-body">
                    <img src="{{$product->image_url}}" alt="Product Image" class="product-image">
                    <div class="product-details">
                        <p class="product-description">{{$product->description}}</p>
                        <p class="product-price">Price: {{$product->price}}</p>
                        <p class="product-quantity">Quantity: {{$product->stock_quantity}}</p>
                    </div>
                </div>

                



                <div class="admin-actions">
                    <a href="{{ route('products.edit', $product->id) }}" class="admin-button edit-button">Edit Product</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="remove-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-button remove-button" onclick="return confirm('Are you sure?')">Remove Product</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <div class="admin-notification notification-error">
            <p>There are no Products currently.</p>
        </div>
    @endif
</div>
@endsection