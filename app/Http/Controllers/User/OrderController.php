<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product' => function ($q) {
    $q->withTrashed(); // لو عندك SoftDeletes
}])->where('user_id', Auth::id())->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }
    public function cancel($id)
{
    $order = Order::where('user_id', Auth::id())
                  ->where('status', 'pending')
                  ->findOrFail($id);

    $order->delete();

    return redirect()->route('myorders.index')->with('success', 'Order cancelled.');
}

}
