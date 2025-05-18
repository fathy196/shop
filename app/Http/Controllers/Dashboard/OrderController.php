<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->payment_method, fn($q) => $q->where('payment_method', $request->payment_method))
            ->when(
                $request->date_from && $request->date_to,
                fn($q) =>
                $q->whereBetween('created_at', [$request->date_from, $request->date_to])
            )
            ->latest()
            ->paginate(10);

        return view('dashboard.orders.index', compact('orders'));
    }


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,approved,shipped,cancelled']);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('status', 'Order status updated.');
    }

}
