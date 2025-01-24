@extends('layouts.master')

@section('title', 'Search Results')

@section('content')
<style>
    /* Gradient Background for Header */
    .bg-gradient-dark {
        background: linear-gradient(135deg, #434343, #000000);
    }

    /* Card Hover Effect */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        background-color: #ffffff; /* White background for cards */
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    /* Button Hover Gradient */
    .btn-hover-gradient {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        border: none;
        color: white;
        transition: background 0.3s ease;
    }

    .btn-hover-gradient:hover {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
    }

    /* Responsive Typography */
    h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
    }

    /* Light Mode Adjustments */
    body {
        background-color: #f8f9fa; /* Light gray background for the page */
    }

    .card {
        background-color: #ffffff; /* White background for cards */
    }

    .text-muted {
        color: #6c757d !important; /* Muted text color */
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        body {
            background-color: #e0dcdc;
            color: #ffffff;
        }
        .card {
            background-color: #f7f5f5;
            border-color: #333;
        }
        .text-muted {
            color: #a0a0a0 !important;
        }
    }
</style>

<!-- Header with Gradient Background -->
<header class="bg-gradient-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder mb-4" style="font-family: 'Poppins', sans-serif;">Shop in Style</h1>
            <p class="lead fw-normal text-white-50 mb-0">Discover our exclusive collection</p>
        </div>
    </div>
</header>

<!-- Search Results Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h1 class="mb-4  text-dark">Search Results for "{{ $query }}"</h1>

        @if ($products->isEmpty())
            <div class="alert alert-info text-center">
                No products found for your search query.
            </div>
        @else
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        <!-- Product Image with Hover Effect -->
                        <div class="card-img-top-container position-relative" style="height: 280px; overflow: hidden;">
                            <img class="card-img-top h-100 w-100" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="object-fit: cover; transition: transform 0.3s ease;">
                        </div>

                        <!-- Product Details -->
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="text-center flex-grow-1">
                                <!-- Product Name -->
                                <h5 class="fw-bolder text-truncate mb-2" title="{{ $product->name }}" style="font-family: 'Poppins', sans-serif;">{{ $product->name }}</h5>
                                <!-- Product Price -->
                                <p class="mb-0 text-muted">EGP {{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>

                        <!-- Product Actions -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-dark btn-hover-gradient mt-auto" href="{{ route('products.show', $product->id) }}">
                                    <i class="bi bi-eye me-2"></i>View Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            {{-- <div class="d-flex justify-content-center mt-5">
                {{ $products->appends(['query' => $query])->links() }}
            </div> --}}
        @endif
    </div>
</section>
@endsection