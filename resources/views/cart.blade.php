@extends('layouts.master')

@section('title', 'Your Cart')

@section('content')
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
                                        @error('quantity.'.$item->product_id)
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                </td>
                                <td class="text-center">EGP {{ number_format($item->quantity * $item->price, 2) }}</td>
                                <td class="text-center">

                                    {{-- <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="removeItem({{ $item->id }})">
                                        <i class="bi bi-trash"></i> Remove
                                    </button> --}}
                                    <button  form="delete-form-{{ $item->id }}" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-outline-primary btn-cart">
                        <i class="bi bi-arrow-clockwise"></i> Update Cart
                    </button>
                </div>
            </form>

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

                {{-- <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="mt-3 btn btn-success btn-cart">
                        <i class="bi bi-credit-card"></i> Proceed to Checkout
                    </button>
                </form> --}}
                    <a href="{{ route('checkout') }}" class="mt-3 btn btn-success ms-2 btn-cart">
                        <i class="bi bi-credit-card"></i> Proceed to Checkout
                    </a>
                </div>
            </div>
    @endif
</div>

{{-- todo: --}}
@foreach ($cartItems as $item)
    
<form method="post" action="{{route('cart.remove',$item->id)}}" id="delete-form-{{ $item->id }}" class="delete-form">
    @csrf
    @method('DELETE')
    {{-- <input type="hidden" name="item_id" id="item_id"> --}}
</form>
@endforeach

@endsection
