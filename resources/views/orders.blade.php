@include('includes.navigation')

<body>
    <div class="container">
        @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="order-item">
            <div>Order ID: {{ $order->id }}</div>
            <div>Order Date: {{ $order->order_date }}</div>
            <div>Total Price: {{ $order->total_price }}</div>
            <div>Status: {{ $order->status }}</div>
            <div>Items:
                <ul>
                    @foreach($order->items as $item)
                    <li>{{ $item->product_name }} - Quantity: {{ $item->quantity }} - Price: {{ $item->price }}</li>
                    @endforeach
                </ul>
            </div>
            <a href='#'>Inspect Order</a>
        </div>
        @endforeach
        @else
        <div style="display: flex; align-items: center; justify-content: center;">
            <div>
                <img src="{{ asset('images/noorder.png') }}" alt="noorder" style="width: 400px; auto: 0">
            </div>
            <div>
                <div>
                    <h2>No orders placed yet</h2>
                    <p>You don't have any orders placed in your history.</p>
                    <a class="btn btn-primary" href="{{ route('products.refresh')}}">Shop All Products</a>
                </div>
            </div>
        </div>
        @endif
    </div>
    @include('includes.footer')
</body>