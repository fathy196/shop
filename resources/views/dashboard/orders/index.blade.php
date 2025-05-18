@extends('dashboard.layouts.app')

@section('title', 'Order Management')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0 text-dark fw-bold">Order Management</h1>
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="exportDropdown"
                    data-bs-toggle="dropdown">
                    <i class="bi bi-download me-2"></i>Export
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">CSV</a></li>
                    <li><a class="dropdown-item" href="#">Excel</a></li>
                    <li><a class="dropdown-item" href="#">PDF</a></li>
                </ul>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">
                <form action="{{ route('dashboard.orders.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select shadow-xs">
                                <option value="">All Statuses</option>
                                @foreach (\App\Helpers\OrderStatusHelper::getAllStatuses() as $value => $label)
                                    <option value="{{ $value }}" @selected(request('status') == $value)>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select shadow-xs">
                                <option value="">All Methods</option>
                                <option value="cash_on_delivery" @selected(request('payment_method') == 'cash_on_delivery')>Cash on Delivery</option>
                                <option value="credit_card" @selected(request('payment_method') == 'credit_card')>Credit Card</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">From Date</label>
                            <input type="date" name="date_from" class="form-control shadow-xs"
                                value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">To Date</label>
                            <input type="date" name="date_to" class="form-control shadow-xs"
                                value="{{ request('date_to') }}">
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary me-2 shadow-sm">
                                <i class="bi bi-funnel me-1"></i> Filter
                            </button>
                            <a href="{{ route('dashboard.orders.index') }}" class="btn btn-outline-secondary shadow-sm">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="ps-4">Order #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr class="border-bottom border-light">
                                    <td class="ps-4 fw-semibold">#{{ $order->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3 bg-light rounded-circle">
                                                <span class="text-primary">{{ substr($order->user->name, 0, 1) }}</span>
                                            </div>
                                            {{ $order->user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                                    <td>EGP {{ number_format($order->total + 80, 2) }}</td>
                                    <td>
                                        <span
                                            class="text-capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge rounded-pill py-1 px-3 bg-{{ \App\Helpers\OrderStatusHelper::getStatusColor($order->status) }}">
                                            <i
                                                class="bi {{ \App\Helpers\OrderStatusHelper::getStatusIcon($order->status) }} me-1"></i>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('dashboard.orders.show', $order->id) }}"
                                                class="btn btn-sm btn-outline-primary rounded-circle shadow-xs"
                                                data-bs-toggle="tooltip" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-secondary rounded-circle shadow-xs"
                                                data-bs-toggle="modal" data-bs-target="#statusModal{{ $order->id }}"
                                                data-bs-toggle="tooltip" title="Edit Status">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Status Update Modal -->
                                <div class="modal fade" id="statusModal{{ $order->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header bg-gray-100 border-0">
                                                <h5 class="modal-title">Update Order #{{ $order->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('dashboard.orders.updateStatus', $order->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('patch')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-select shadow-xs">
                                                            @foreach (\App\Helpers\OrderStatusHelper::getAllStatuses() as $value => $label)
                                                                <option value="{{ $value }}"
                                                                    @selected($order->status == $value)>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-gray-50 border-0">
                                                    <button type="button" class="btn btn-outline-secondary shadow-sm"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary shadow-sm">Update
                                                        Status</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="bi bi-box-seam display-4 text-muted"></i>
                                            <h5 class="mt-3 mb-1">No orders found</h5>
                                            <p class="text-muted">Try adjusting your filters</p>
                                            <a href="{{ route('dashboard.orders.index') }}"
                                                class="btn btn-sm btn-outline-primary mt-3">
                                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($orders->hasPages())
                    <div class="p-3 border-top border-light">
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
