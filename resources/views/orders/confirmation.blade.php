@extends('layouts.master')

@section('title', 'Order Confirmation')

@section('content')
<div class="container my-5 order-container">
    <div class="text-center">
        <i class="bi bi-check-circle-fill order-success-icon" style="font-size: 4rem;"></i>
        <h1 class="mb-3 text-dark fw-bold">Order Confirmed!</h1>
        <p><h5 class="text-dark">Thank you for your order #{{ $order->id }}</h5></p>
        <p class="text-dark">We've sent a confirmation email to <strong>{{ $order->user->email }}</strong></p>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card shadow-sm rounded order-card">
                <div class="card-header order-card-header">
                    <h4 class="mb-0 fw-bold order-card-title">Order Details</h4>
                </div>
                <div class="card-body">
                    <p><strong>Order Number:</strong> #{{ $order->id }}</p>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y \a\t g:i a') }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($order->status) }}</span></p>
                    <p><strong>Payment Method:</strong> {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><strong>Total:</strong> <span class="order-summary-total">EGP {{ number_format($order->total + 80, 2) }}</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm rounded order-card">
                <div class="card-header order-card-header">
                    <h4 class="mb-0 fw-bold order-card-title">Shipping Information</h4>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
                    <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm rounded mt-4 order-card">
        <div class="card-header order-card-header">
            <h4 class="mb-0 fw-bold order-card-title">Order Items</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item->product->image_path) }}" 
                                             alt="{{ $item->product->name }}" class="order-img me-3">
                                        <span>{{ $item->product->name }}</span>
                                    </div>
                                </td>
                                <td>EGP {{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>EGP {{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-outline-primary me-2 order-btn order-btn-outline">
            <i class="bi bi-house"></i> Continue Shopping
        </a>
        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary order-btn order-btn-primary">
            <i class="bi bi-receipt"></i> View Order Details
        </a>
    </div>
</div>


@endsection