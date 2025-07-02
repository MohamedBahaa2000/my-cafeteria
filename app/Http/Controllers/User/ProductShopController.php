<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductShopController extends Controller
{
    public function index(request $request)
    {
        $categoryId = $request->query('category');

    $query = Product::where('is_available', true);

    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    $products = $query->latest()->paginate(12);
    $categories = Category::all();

    return view('user.shop.index', compact('products', 'categories', 'categoryId'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        $qty = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $qty,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    public function viewCart()
{
    $cart = session()->get('cart', []);
    $cartItems = [];

    foreach ($cart as $productId => $item) {
        $product = Product::with('category')->find($productId);

        if ($product) {
            $cartItems[] = [
                'product' => $product,
                'quantity' => $item['quantity'],
            ];
        }
    }

    return view('user.cart.index', compact('cartItems'));
}


    public function placeOrder()
    {
        $cart = session('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('shop')->with('error', 'Cart is empty!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('shop')->with('success', 'Order placed successfully!');
    }
    public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
}

}
