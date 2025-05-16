@extends('layouts.master')

@section('title', 'Checkout')

@section('content')
<div class="container my-5 order-container">
    <h1 class="mb-4 text-center text-dark fw-bold">Checkout</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm rounded mb-4 order-card">
                <div class="card-header bg-light order-card-header">
                    <h4 class="mb-0 fw-bold order-card-title">Shipping Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Shipping Address</label>
                            <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                      id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       id="cash_on_delivery" value="cash_on_delivery" checked>
                                <label class="form-check-label" for="cash_on_delivery">
                                    Cash on Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       id="credit_card" value="credit_card">
                                <label class="form-check-label" for="credit_card">
                                    Credit Card
                                </label>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm rounded order-card">
                <div class="card-header bg-light order-card-header">
                    <h4 class="mb-0 fw-bold order-card-title">Order Summary</h4>
                </div>
                <div class="card-body">
                    @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">x{{ $item->quantity }}</small>
                            </div>
                            <span>EGP {{ number_format($item->quantity * $item->price, 2) }}</span>
                        </div>
                    @endforeach

                    <hr class="my-3">

                    <div class="order-summary-item">
                        <span class="text-muted">Subtotal:</span>
                        <span class="text-dark fw-semibold">EGP {{ number_format($total, 2) }}</span>
                    </div>

                    <div class="order-summary-item">
                        <span class="text-muted">Shipping:</span>
                        <span class="text-dark fw-semibold">EGP 80.00</span>
                    </div>

                    <hr class="my-3">

                    <div class="order-summary-item">
                        <span class="fw-bold fs-5">Total:</span>
                        <span class="fw-bold fs-5 text-primary order-summary-total">EGP {{ number_format($total + 80, 2) }}</span>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-3 order-btn order-btn-primary">
                        <i class="bi bi-check-circle"></i> Place Order
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection