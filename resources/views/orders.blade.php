@include('includes.navigation')
<body>
        <h1>Orders</h1>
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
            @endif
    </div>
@include('includes.footer')
</body>