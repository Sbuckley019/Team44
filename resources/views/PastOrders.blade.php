<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Orders</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('includes.navigation')

    <div class="container mt-4">
        <h2 class="mb-4">Past Orders</h2>
        @if (!empty($orders))
            <div class="card">
                <div class="card-body">
                    <div class="list-group">
                        @foreach ($orders as $order)
                            <div class="list-group-item">
                                <h5 class="mb-1">Order #{{ $order->id }} - Placed on {{ $order->created_at->format('d M Y') }}</h5>
                                <p class="mb-1">Total Cost: ${{ number_format($order->total_cost, 2) }}</p>
                                <a href="{{ route('order.details', $order->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <p>You have no past orders.</p>
        @endif
    </div>

    @include('includes.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

