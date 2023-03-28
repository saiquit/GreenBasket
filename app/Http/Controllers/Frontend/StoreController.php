<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DeliveryCost;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function home(Request $request)
    {
        return view('frontend.store.home');
    }
    public function store(Request $request)
    {
        $categories_list = Category::limit(4)->get();
        $products_q = Product::query();
        if ($request->has('cat')) {
            $products_q->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->cat);
            });
        }
        $products = $products_q->orderBy('created_at', 'desc')->paginate(36);
        return view('frontend.store.store', compact('products', 'categories_list'));
    }
    public function categoryList(Request $request, $slug)
    {
        $categories = Category::where('slug', $slug)->get();
        return view('frontend.store.category', compact('categories'));
    }
    public function singleProduct(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('frontend.store.single_product', compact('product'));
    }
    public function showCart(Request $request)
    {
        if (!session('cart.items')) {
            return redirect()->back()->with(['message' => 'No Cart Items.', 'alert-type' => 'error']);
        } elseif (!session('cart.district_id')) {
            return redirect()->back()->with(['message' => 'Set A District First.', 'alert-type' => 'error']);
        }
        $divisions = DeliveryCost::all();
        return view('frontend.store.cart', compact('divisions'));
    }
    public function showCheckout(Request $request)
    {
        if (!session('cart.items')) {
            return redirect()->back()->with(['message' => 'No Cart Items.', 'alert-type' => 'error']);
        }
        $cartItems = session('cart.items');
        $subTotal = session('cart.subTotal');
        $increment_cost = floatVal(DeliveryCost::findOrFail(session('cart.district_id'))['increment_cost']);
        $delivery_cost = session('cart.base_dl') + (floatVal(session('cart.weight')) - 1) * $increment_cost;
        $total = $subTotal + $delivery_cost;
        return view('frontend.store.checkout', [
            'total' => $total,
            'cartItems' => $cartItems,
            'delivery_cost' => $delivery_cost
        ]);
    }
}
