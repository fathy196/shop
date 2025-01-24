@extends('layouts.master')

@section('title', 'Your Cart')

@section('content')
<style>
    /* Gradient Background for Header */
    .bg-gradient-cart {
        background: linear-gradient(135deg, #434343, #000000);
    }

    /* Modern Typography */
    h1 {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2rem, 5vw, 3rem);
    }

    /* Table Styling */
    .table-cart {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .table-cart th {
        background-color: #000000;
        color: rgb(7, 7, 7);
        font-weight: 600;
    }

    .table-cart td {
        vertical-align: middle;
    }

    /* Image Styling */
    .cart-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Quantity Input Styling */
    .quantity-input {
        width: 80px;
        margin: auto;
        text-align: center;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 5px;
    }

    /* Button Styling */
    .btn-cart {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Cart Summary Styling */
    .cart-summary {
        background-color: #0d0d0d;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        body {
            background-color: #c1c1c1;
            color: #ffffff;
        }
        .table-cart th {
            background-color: #efecec;
        }
        .table-cart td {
            background-color: #efecec;
            color: #0d0c0c;
        }
        .cart-summary {
            background-color: #efecec;
            color: #121111;
        }
        .text-muted {
            color: #0c0b0b !important;
        }
    }

    /* Empty Cart Styling */
    .empty-cart {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .empty-cart i {
        font-size: 3rem;
        color: #6a11cb;
    }

    .empty-cart p {
        font-size: 1.2rem;
        color: #555;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .cart-img {
            width: 60px;
            height: 60px;
        }
        .quantity-input {
            width: 60px;
        }
    }
</style>
    <div class="container my-5">
    <h1 class="mb-4 text-center text-dark fw-bold">Your Shopping Cart</h1>

    @if ($cartItems->isEmpty())
        <div class="empty-cart">
            <i class="bi bi-cart-x"></i>
            <p class="mt-3">Your cart is currently empty.
                <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-primary">Continue shopping</a>.
            </p>
        </div>
    @else
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="table-responsive shadow-sm rounded table-cart">
                <table class="table table-bordered align-middle">
                    <thead class="text-center">
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
                                        class="cart-img me-3">
                                    <div>
                                        <h5 class="mb-0 fw-semibold">{{ $item->product->name }}</h5>
                                    </div>
                                </td>
                                <td class="text-center">EGP {{ number_format($item->price, 2) }}</td>
                                <td class="text-center">
                                    <input type="number" name="quantity[{{ $item->product_id }}]"
                                        value="{{ $item->quantity }}" min="1" class="form-control quantity-input">
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
                <div class="cart-summary">
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
                    <button type="submit" class="btn btn-outline-primary btn-cart">
                        <i class="bi bi-arrow-clockwise"></i> Update Cart
                    </button>
                    {{-- <a href="{{ route('checkout') }}" class="btn btn-success ms-2 btn-cart">
                        <i class="bi bi-credit-card"></i> Proceed to Checkout
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
