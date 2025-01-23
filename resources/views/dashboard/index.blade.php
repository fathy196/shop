@extends('layouts.master')
@section('title', 'Products')
@section('content')

    <div class="container my-5">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 text-primary fw-bold">Product Management</h1>
            <p class="text-muted">Manage your products and categories easily from here.</p>
        </div>

        <!-- Products Section -->
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Products</h2>
                <button class="btn btn-light btn-sm" onclick="window.location.href='{{ route('products.create') }}'">
                    <i class="bi bi-plus-circle"></i> Add Product
                </button>
            </div>
            <div class="card-body">
                <!-- Product List or Message -->
                @if (count($products) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="row">
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-sm btn-outline-primary me-2"
                                                        href="{{ route('products.edit', $product->id) }}">
                                                        Edit
                                                    </a>
                                                    {{-- Uncomment for Delete Button --}}

                                                    <form method="POST"
                                                        action="{{ route('products.destroy', $product->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        @else
            <p class="text-center">No products found.</p>
            @endif
        </div>
    {{-- </div> --}}


    <!-- Categories Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Categories</h2>
            <button class="btn btn-light btn-sm" onclick="window.location.href='{{ route('categories.create') }}'">
                <i class="bi bi-plus-circle"></i> Add Category
            </button>
        </div>
        <div class="card-body">
            @if (count($categories))
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-sm btn-outline-primary me-2"
                                                href="{{ route('categories.edit', $category->id) }}">
                                                Edit
                                            </a>
                                            {{-- Uncomment for Delete Button --}}

                                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted">No Categories Found.</p>
            @endif
        </div>
    </div>
    </div>

@endsection
