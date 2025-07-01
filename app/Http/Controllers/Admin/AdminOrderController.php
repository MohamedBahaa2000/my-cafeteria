<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;


class AdminOrderController extends Controller
{
    public function index(Request $request)
{
    $query = Order::with('user');

    // فلترة بالتاريخ
    if ($request->start_date) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->end_date) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    // فلترة بالحالة (اختياري)
    if ($request->status) {
        $query->where('status', $request->status);
    }

    $orders = $query->latest()->paginate(10);

    return view('admin.orders.index', compact('orders'));
}
    public function show($id)
{
    $order = \App\Models\Order::with(['user', 'items.product'])->findOrFail($id);

    return view('admin.orders.show', compact('order'));
}

public function create()
{
    $users = User::where('is_admin', 0)->get();
    $products = Product::where('is_available', true)->get();

    return view('admin.orders.create', compact('users', 'products'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'products' => 'required|array',
    ]);

    $order = \App\Models\Order::create([
        'user_id' => $request->user_id,
        'status' => 'pending',
    ]);

    foreach ($request->products as $productId => $quantity) {
        if ($quantity > 0) {
            $product = \App\Models\Product::find($productId);
            $order->items()->create([
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $quantity,
            ]);
        }
    }

    return redirect()->route('orders.index')->with('success', 'Order created successfully.');
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
