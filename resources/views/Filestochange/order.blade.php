@include('includes.navigation')

<body>
    <div class="container">
        <div>
            @if(@isset($orders))
            @foreach($orders as $order)
            <div class="order-item">
                <div>{{$order->order_id}}</div>
                <div>{{$order->order_date}}</div>
                <div>{{$order->total_price}}</div>
                <div>{{$order->status}}</div>
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
                        <h2>No order placed yet</h2>
                        <p>You don't have any orders placed in your history.</p>
                        <a class="btn btn-primary" href="{{ route('products.refresh')}}">Shop All Products</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @include('includes.footer')
</body>