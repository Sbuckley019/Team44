@extends('admin.layout')

@section('content')
<style>
    .customer-management-container {
        width: 100%;
        padding: 20px;
        margin-top: 20px;
    }

    .customer-management-heading {
        font-size: 24px;
        color: #333;
        margin-bottom: 30px;
    }

    .customer-card {
        background-color: #ffffff;
        border: 1px solid #eaeaea;
        border-radius: 6px;
        margin-bottom: 20px;
        padding: 15px;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
    }

    .customer-info {
        padding: 10px;
    }

    .customer-title {
        font-size: 18px;
        margin-bottom: 5px;
        color: #555;
    }

    .no-customers-message {
        font-size: 18px;
        color: #888888;
        margin-top: 20px;
    }
</style>

<div class="customer-management-container">
    <h2 class="customer-management-heading">Manage Customers</h2>
    @if (!empty($users))
        @foreach ($users as $user)
            <div class="customer-card">
                <div class="customer-info">
                    <h5 class="customer-title">User #{{ $user->id }} - {{ $user->username }}</h5>
                </div>
            </div>
        @endforeach
    @else
        <p class="no-customers-message">There are no Customers currently.</p>
    @endif
</div>
@endsection