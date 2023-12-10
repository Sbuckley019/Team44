@include('includes.navigation')
<body>
        <h1>Orders</h1>
        <div class="container">
        <div>
            @foreach($orders as $order)
            <div class="order-item">
                <div>{{$order->order_id}}</div>
                <div>{{$order->order_date}}</div>
                <div>{{$order->total_price}}</div>
                <div>{{$order->status}}</div>
                <a href='#'>Inspect Order</a>
            </div>
    </div>
@include('includes.footer')
</body>