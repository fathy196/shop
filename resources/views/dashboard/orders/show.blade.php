@extends('dashboard.layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-dark fw-bold">Order #{{ $order->id }}</h1>
        <a href="{{ route('dashboard.orders.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Back to Orders
        </a>
    </div>

    <!-- Order Info -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">Customer Information</h5>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
            <p><strong>Payment Method:</strong> {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
            <p><strong>Status:</strong>
                <span class="badge rounded-pill py-1 px-3 bg-{{ \App\Helpers\OrderStatusHelper::getStatusColor($order->status) }}">
                    <i class="bi {{ \App\Helpers\OrderStatusHelper::getStatusIcon($order->status) }} me-1"></i>
                    {{ ucfirst($order->status) }}
                </span>
            </p>
        </div>
    </div>

    <!-- Order Items -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <h5 class="fw-semibold px-4 pt-4">Order Items</h5>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="ps-4">Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-bottom border-light">
                                <td class="ps-4">{{ $item->product->name }}</td>
                                <td>EGP {{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>EGP {{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="fw-bold">
                            <td class="ps-4" colspan="3" class="text-end">Subtotal</td>
                            <td>EGP {{ number_format($order->total, 2) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td class="ps-4" colspan="3" class="text-end">Delivery</td>
                            <td>EGP 80.00</td>
                        </tr>
                        <tr class="fw-bold">
                            <td class="ps-4" colspan="3" class="text-end">Total</td>
                            <td>EGP {{ number_format($order->total + 80, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
