<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard - @yield('title')</title>
</head>
<body>
    <header id="admin-header">
        <h1>Admin Dashboard</h1>
    </header>

    <aside id="admin-sidebar">
        <!-- Sidebar content -->
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('products.adminIndex') }}">Products</a></li>
            <li><a href="{{ route('order.index') }}">Orders</a></li>
            <li><a href="{{ route('customer.index') }}">Customers</a></li>
            <li><a href="{{route('feedback.index')}}">Feedback</a></li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="logoutButton" type="submit">Logout</button>
                </form>
            </li>
            
            <!-- Add more links as needed -->
        </ul>
    </aside>

    
    <main id="admin-content">
        @yield('content')
    </main>

    @include('includes.footer')


    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>