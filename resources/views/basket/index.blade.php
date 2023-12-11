@include('includes.navigation')

<body>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('content')
    <div class="container">
        <h1>Your Basket</h1>

        @if($basket->items->isEmpty())
        <p>Your basket is empty.</p>
        @else
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($basket->items as $item)
                <tr>
                    <td>
                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" width="50">
                        {{ $item->product_name }}
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->product->price }}</td>
                    <td>${{ $item->quantity * $item->product->price }}</td>
                    <td>
                        <form action="{{ route('basket.remove', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                        <form action="{{ route('basket.update', $item->id) }}" method="post">
                            @csrf
                            <label for="quantity">Update Quantity:</label>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Total: ${{ $basket->total }}</p>
        @endif
    </div>
    @endsection
    @include('includes.footer')
</body>