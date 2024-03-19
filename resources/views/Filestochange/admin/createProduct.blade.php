@extends('admin.layout')

@section('title', 'Create Product')

@section('content')

<style>
.product-form-wrapper {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

.notification {
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.notification-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.notification-error {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}


.form-field {
    margin-bottom: 1rem;
}

.input-field,
.textarea-field,
.select-field {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.action-button {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.primary-action {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
</style>

<div class="product-form-wrapper">
    <h1>Add New Product</h1>
    <div>
        @if(session('success'))
            <div class="notification notification-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="notification notification-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-field">
                <label for="product_name">Product Name:</label>
                <input type="text" class="input-field" id="product_name" name="product_name" required>
            </div>

            <div class="form-field">
                <label for="description">Description:</label>
                <textarea class="textarea-field" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="form-field">
                <label for="price">Price:</label>
                <input type="text" class="input-field" id="price" name="price" required>
            </div>

            <div class="form-field">
                <label for="category_id">Category:</label>
                <select class="select-field" id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-field">
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" class="input-field" id="stock_quantity" name="stock_quantity" required>
            </div>

            <div class="form-field">
                <label for="image">Product Image:</label>
                <input type="file" class="input-field" id="image" name="image">
            </div>
                        
            <button type="submit" class="action-button primary-action">Submit</button>
        </form>
    </div>
</div>

@endsection