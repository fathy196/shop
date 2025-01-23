@extends('layouts.master')

@section('title', 'Your Cart')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center text-dark fw-bold">Your Shopping Cart</h1>
        {{-- @dump(session('status')) --}}

        @if ($cartItems->isEmpty())
            <div class="alert alert-light text-center shadow-sm py-5">
                <i class="bi bi-cart-x fs-1 text-muted"></i>
                <p class="mt-3 text-muted">Your cart is currently empty.
                    <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-primary">Continue
                        shopping</a>.
                </p>
            </div>
        @else
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-bordered align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ asset($item->product->image_path) }}" alt="{{ $item->product->name }}"
                                            class="img-thumbnail me-3" style="width: 80px; height: 80px;">
                                        <div>
                                            <h5 class="mb-0 fw-semibold">{{ $item->product->name }}</h5>
                                        </div>
                                    </td>
                                    <td class="text-center">EGP {{ number_format($item->price, 2) }}</td>
                                    <td class="text-center">
                                        <input type="number" name="quantity[{{ $item->product_id }}]"
                                            value="{{ $item->quantity }}" min="1" class="form-control text-center"
                                            style="width: 80px; margin: auto;">
                                    </td>
                                    <td class="text-center">EGP {{ number_format($item->quantity * $item->price, 2) }}</td>
                                    <td class="text-center">

                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="removeItem({{ $item->id }})">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-end">
                    <div class="bg-light p-4 rounded shadow-sm">
                        <h4 class="fw-bold mb-3">Cart Summary</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span class="text-dark fw-semibold">EGP {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping:</span>
                            <span class="text-dark fw-semibold">EGP 80.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold fs-5">Total:</span>
                            <span class="fw-bold fs-5 text-primary">EGP {{ number_format($total + 80, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-clockwise"></i> Update Cart
                        </button>
                        {{-- <a href="{{ route('checkout') }}" class="btn btn-success ms-2"> --}}
                        {{-- <i class="bi bi-credit-card"></i> Proceed to Checkout
                    </a> --}}
                    </div>
                </div>
            </form>
        @endif
    </div>

    {{-- this script for handling remove cart --}}
    <script>
        function removeItem(itemId) {
            if (confirm('Are you sure you want to remove this item?')) {
                fetch(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        window.location.reload(); // Reload the page to reflect changes
                    }
                });
            }
        }
    </script>
@endsection
