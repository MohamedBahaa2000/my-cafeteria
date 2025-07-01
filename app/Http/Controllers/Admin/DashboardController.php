<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $totalOrders = Order::count();
    $pendingOrders = Order::where('status', 'pending')->count();
    $processingOrders = Order::where('status', 'processing')->count(); // ✅ الجديد
    $deliveredOrders = Order::where('status', 'delivered')->count();

    $sales = Order::where('status', 'delivered')->with('items')->get()
        ->flatMap->items
        ->sum(function ($item) {
            return $item->price * $item->quantity;
        });

    return view('admin.dashboard', compact(
        'totalOrders',
        'pendingOrders',
        'processingOrders',
        'deliveredOrders',
        'sales'
    ));
}

}
