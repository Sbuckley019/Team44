@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Manage Customers</h2>
        <div class="container mt-4">
            @if (!empty($users))
                <div class="card">
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($users as $user)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">User #{{ $user->id }} {{$user->username}}</h5>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            @else
                <p>There are no Customers currently.</p>
            @endif
        </div>
    </div>
</div>
@endsection