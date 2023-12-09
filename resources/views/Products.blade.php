<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .product-card {
            position: relative;
            width: 300px;
            border: 1px solid #ddd;
            margin: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .product-details {
            padding: 20px;
        }

        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #e8491d;
            margin-bottom: 10px;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
        }

        .favorite-btn{
            position: absolute;
            top: 20;
            right: 18;
        }

        .favorite-btn,
        .add-to-cart-btn {
            background-color: #e8491d;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .favorite-btn:hover,
        .add-to-cart-btn:hover {
            background-color: #c43117;
        }
    </style>
</head>
@include('includes.navigation')
<body>
    @foreach ($products as $product)
    <div class="product-card">
        <img class="product-image" src="{{$product->image_url}}" alt="Product Image">
        <div class="product-details">
            <div class="product-name">{{$product->product_name}}</div>
            <div class="product-description">{{$product->description}}</div>
            <div class="product-price">${{$product->price}}</div>
            <div class="action-buttons">
                <button class="favorite-btn"><i class="fas fa-heart"></i></button>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>
    </div>
@endforeach

@include('includes.footer');
</body>