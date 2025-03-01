@extends('layouts.master')

@section('title', 'Shop Homepage')

@section('content')
<!-- Header with Gradient Background -->
<header class="bg-gradient-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder mb-4" style="font-family: 'Poppins', sans-serif;">Shop in Style</h1>
            <p class="lead fw-normal text-white-50 mb-0">Discover our exclusive collection</p>
        </div>
    </div>
</header>

<!-- Product Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
            <div class="col mb-5">
                <div class="card h-100 shadow-sm border-0 overflow-hidden">
                    <!-- Product Image with Hover Effect -->
                    <div class="card-img-top-container position-relative" style="height: 280px; overflow: hidden;">
                        <img class="card-img-top h-100 w-100" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="object-fit: cover; transition: transform 0.3s ease;">
                        <!-- Sale Badge (Optional) -->
                        {{-- @if($product->on_sale)
                        <div class="badge bg-danger position-absolute" style="top: 0.5rem; right: 0.5rem;">Sale</div>
                        @endif --}}
                    </div>

                    <!-- Product Details -->
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="text-center flex-grow-1">
                            <!-- Product Name -->
                            <h5 class="fw-bolder text-truncate mb-2" title="{{ $product->name }}" style="font-family: 'Poppins', sans-serif;">{{ $product->name }}</h5>
                            <!-- Product Price -->
                            <p class="mb-0 text-muted">EGP {{ number_format($product->price, 2) }}</p>
                            <!-- Product Reviews (Optional) -->
                            {{-- @if($product->rating)
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                @for($i = 0; $i < 5; $i++)
                                <div class="bi-star-fill"></div>
                                @endfor
                            </div>
                            @endif --}}
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
    </div>
</section>
{{-- <section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Fancy Product</h5>
                            <!-- Product price-->
                            $40.00 - $80.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Special Item</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">$20.00</span>
                            $18.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Sale Item</h5>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">$50.00</span>
                            $25.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Popular Item</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            $40.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection