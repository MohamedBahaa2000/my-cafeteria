<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
     public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
{
    $order = \App\Models\Order::with(['user', 'items.product'])->findOrFail($id);

    return view('admin.orders.show', compact('order'));
}
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,processing,delivered',
    ]);

    $order = \App\Models\Order::findOrFail($id);
    $order->status = $request->input('status');
    $order->save();

    return redirect()->route('orders.show', $id)->with('success', 'Order status updated!');
}

}
