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

    <style>
        :root {
            --bg-offwhite: #f8f9fa;
            --bg-light: #ffffff;
            --border-light: #e9ecef;
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
        }

        /* Light Mode Styles */
        .card {
            background-color: var(--bg-light);
            border-radius: 12px;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.02);
            --bs-table-hover-bg: rgba(0, 0, 0, 0.04);
            color: var(--text-primary);
        }

        .table th {
            font-weight: 600;
            color: var(--text-secondary);
            border-bottom-width: 1px;
        }

        .bg-gray-100 {
            background-color: var(--bg-offwhite) !important;
        }

        .bg-gray-50 {
            background-color: rgba(248, 249, 250, 0.8) !important;
        }

        .border-light {
            border-color: var(--border-light) !important;
        }

        .shadow-xs {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        /* Dark Mode Styles */
        @media (prefers-color-scheme: dark) {
            :root {
                --bg-offwhite: #e1e1e1;
                --bg-light: #f2f3f5;
                --border-light: #2d3748;
                --text-primary: #040404;
                --text-secondary: #040404;
            }

            body {
                background-color: #898989;
            }

            .card {
                box-shadow: 0 4px 12px rgba(117, 75, 75, 0.15);
            }

            .table {
                --bs-table-hover-bg: rgba(255, 255, 255, 0.735);
            }

            .form-control,
            .form-select {
                background-color: rgb(255, 255, 255);
                border-color: rgba(255, 255, 255, 0.1);
                color: var(--text-primary);
            }

            .modal-content {
                background-color: var(--bg-light);
            }

            .btn-outline-secondary {
                border-color: rgba(255, 255, 255, 0.2);
                color: var(--text-primary);
            }

            .empty-state i {
                color: #4a5568;
            }
        }

        /* Status Badges */
        .badge.bg-warning {
            background-color: #f6ad55 !important;
            color: #1a202c !important;
        }

        .badge.bg-info {
            background-color: #63b3ed !important;
            color: white !important;
        }

        .badge.bg-primary {
            background-color: #4299e1 !important;
            color: white !important;
        }

        .badge.bg-danger {
            background-color: #fc8181 !important;
            color: white !important;
        }

        .badge.bg-success {
            background-color: #68d391 !important;
            color: white !important;
        }
    </style>



    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })
    </script>
@endsection
