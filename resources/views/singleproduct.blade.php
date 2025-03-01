@extends('layouts.master')

@section('title', $product->name)

@section('content')


<!-- Header Section (Same as Homepage) -->
<header class="bg-gradient-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder mb-4" style="font-family: 'Poppins', sans-serif;">Shop in Style</h1>
            <p class="lead fw-normal text-white-50 mb-0">Discover our exclusive collection</p>
        </div>
    </div>
</header>
<!-- Product Details Section -->
<section class="py-4"> <!-- Reduced padding -->
    <div class="container px-4 px-lg-5 my-4"> <!-- Reduced margin -->
        <div class="row gx-4 gx-lg-5 align-items-center product-details">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" />
            </div>
            <div class="col-md-6">
                <div class="small mb-1 text-muted">{{ $product->category->name }}</div>
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                <div class="small mb-1 text-muted">{{ $product->quantity }} items left</div>
                <div class="fs-5 mb-5">
                    <span>EGP {{ $product->price }}</span>
                </div>
                <p class="lead">{{ $product->description }}</p>
                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="d-flex">
                        <input class="form-control text-center me-3" name="quantity" id="inputQuantity" type="number" value="1" style="max-width: 3rem" min="1" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
<section class="py-4 related-products"> <!-- Reduced padding -->
    <div class="container px-4 px-lg-5 mt-4"> <!-- Reduced margin -->
        <h2 class="fw-bold mb-4 text-center">Related Products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 justify-content-center">
            @if ($relatedProducts->isEmpty())
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No related products found.</p>
                </div>
            @else
                @foreach ($relatedProducts as $relatedProduct)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product Image -->
                        <img class="card-img-top-container position-relative" src="{{ asset($relatedProduct->image_path) }}" alt="{{ $relatedProduct->name }}" />
                        <!-- Product Details -->
                        <div class="card-body p-4 text-center">
                            <h5 class="fw-bolder mb-2">{{ $relatedProduct->name }}</h5>
                            <p class="text-muted fs-5 mb-0">EGP {{ $relatedProduct->price }}</p>
                        </div>
                        <!-- Product Actions -->
                        <div class="card-footer p-4 pt-0 bg-light border-top-0 text-center">
                            <a class="btn btn-outline-dark btn-sm px-4 text-uppercase fw-bold" href="{{ route('products.show', $relatedProduct->id) }}">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        {{$relatedProducts->links('layouts.components.pagination')}}
    </div>
</section>

@endsection