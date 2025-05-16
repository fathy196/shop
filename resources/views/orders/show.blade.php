@extends('layouts.master')

@section('title', 'Order Details')

@section('content')
<div class="container my-5 order-container">
    <h1 class="mb-4 text-center text-dark fw-bold">Order Details #{{ $order->id }}</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm rounded mb-4 order-card">
                <div class="card-header order-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold order-card-title">Order Items</h4>
                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'approved' ? 'info' : ($order->status == 'shipped' ? 'primary' : 'danger')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
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
                                    <th>Status</th>
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
                                        <td>
                                            <span class="badge bg-{{ $item->status == 'pending' ? 'warning' : ($item->status == 'approved' ? 'info' : ($item->status == 'shipped' ? 'primary' : 'danger')) }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm rounded mb-4 order-card">
                <div class="card-header order-card-header">
                    <h4 class="mb-0 fw-bold order-card-title">Order Summary</h4>
                </div>
                <div class="card-body">
                    <div class="order-summary-item">
                        <span class="text-muted">Subtotal:</span>
                        <span class="text-dark fw-semibold">EGP {{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="order-summary-item">
                        <span class="text-muted">Shipping:</span>
                        <span class="text-dark fw-semibold">EGP 80.00</span>
                    </div>
                    <div class="order-summary-item">
                        <span class="text-muted">Payment Method:</span>
                        <span class="text-dark fw-semibold">{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</span>
                    </div>
                    <hr>
                    <div class="order-summary-item">
                        <span class="fw-bold fs-5">Total:</span>
                        <span class="fw-bold fs-5 order-summary-total">EGP {{ number_format($order->total + 80, 2) }}</span>
                    </div>
                </div>
            </div>

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

    <div class="text-center mt-3">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary order-btn order-btn-outline">
            <i class="bi bi-arrow-left"></i> Back to Order History
        </a>
    </div>
</div>
@endsection