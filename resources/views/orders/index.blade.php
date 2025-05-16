@extends('layouts.master')

@section('title', 'Order History')

@section('content')
<div class="container my-5 order-container">
    <h1 class="mb-4 text-center text-dark fw-bold">Your Order History</h1>

    @if($orders->isEmpty())
        <div class="empty-order text-center py-5">
            <i class="bi bi-box-seam empty-order-icon" style="font-size: 4rem;"></i>
            <p class="mt-3 text-dark fs-5">You haven't placed any orders yet.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3 order-btn order-btn-primary">
                <i class="bi bi-cart"></i> Start Shopping
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table order-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="text-black">#{{ $order->id }}</td>
                            <td class="text-black">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="text-black">{{ $order->items->sum('quantity') }}</td>
                            <td class="text-black">EGP {{ number_format($order->total + 80, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'approved' ? 'info' : ($order->status == 'shipped' ? 'primary' : 'danger')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary order-btn order-btn-outline">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
        {{$orders->links('layouts.components.pagination')}}
        </div>
    @endif
</div>

@endsection