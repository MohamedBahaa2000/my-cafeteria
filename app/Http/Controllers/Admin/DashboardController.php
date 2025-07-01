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
    $deliveredOrders = Order::where('status', 'delivered')->count();
    $totalSales = Order::with('items')
        ->get()
        ->flatMap->items
        ->sum(fn($item) => $item->price * $item->quantity);

    return view('admin.dashboard', compact(
        'totalOrders',
        'pendingOrders',
        'deliveredOrders',
        'totalSales'
    ));
    }
}
