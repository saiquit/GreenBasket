<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCost;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = Session::get('cart.items');
        if (isset($cart[$request->id])) {
            $cart[$request->id]['qty'] += 1;
            $updated_cart = $this->updateSessions($request, $cart);
        } else {
            $cart[$request->id] = Variation::findOrFail($request->id);
            $cart[$request->id]['qty'] += 1;
            $updated_cart = $this->updateSessions($request, $cart);
        }
        if ($request->ajax()) {
            return response()->json($updated_cart, 201);
        } else {
            return redirect()->back()->with(['message' => 'Item Added!', 'alert-type' => 'success']);
        }
    }
    public function removeFromCart(Request $request)
    {
        $cart = Session::get('cart.items');
        if ($cart[$request->id]['qty'] == 1) {
            $this->deleteItemFromCart($request, $request->id);
            return response()->json(['message' => 'Item removed!'], 200);
        } else {
            $cart[$request->id]['qty'] -= 1;
            $updated_cart = $this->updateSessions($request, $cart);
            $updated_cart['message'] = "Item removed!";
            return response()->json($updated_cart, 201);
        }
    }
    public function deleteItemFromCart(Request $request, $id)
    {
        $cart = session('cart.items');
        foreach ($cart as $key => $value) {
            if ($value['id'] == $id) {
                unset($cart[$key]);
            }
        }
        //put back in session array without deleted item
        $this->updateSessions($request, $cart);
        //then you can redirect or whatever you need
        if (!count($cart)) {
            return redirect()->route('front.home');
        } else {
            return redirect()->back();
        }
    }

    public function calculateDelivery(Request $request)
    {
        $district =  $request->district;
        $cost = floatval(DeliveryCost::where('id', $district)->first()->base_cost);
        $inc_cost = floatval(DeliveryCost::where('id', $district)->first()->increment_cost);
        Session::put('cart.base_dl', $cost);
        Session::put('cart.inc_dl', $inc_cost);
        Session::put('cart.district_id', $district);
        if ($request->ajax()) {
            return response()->json([
                'message' => 'successful'
            ], 200);
        }
        return redirect()->back()->with('selectedId', $district);
    }
    protected function updateSessions(Request $request, $cart)
    {
        Session::put('cart.items', $cart);
        $cartQty = 0;
        $subTotal = 0;
        $cartWeight = 0;
        if (count($cart)) {
            foreach ($cart as $key => $item) {
                $cartQty += $item['qty'];
                $cartWeight += floatval($cart[$item->id]['weight']) * $item['qty'];
                $subTotal += $cart[$item->id]->price->price  * $item['qty'];
            }
            Session::put('cart.qty', $cartQty);
            Session::put('cart.weight', $cartWeight);
            Session::put('cart.subTotal', $subTotal);
        } else {
            Session::put('cart.base_dl', 0);
            Session::put('cart.weight', 0);
            Session::put('cart.qty', 0);
        }
        return [
            'cart'    => $cart,
            'subTotal' => $subTotal,
            'total' => $subTotal + ($cartWeight * session('cart.base_dl')),
            'base_dl' => session('cart.base_dl') ? session('cart.base_dl') : 0,
            'inc_dl' => session('cart.inc_dl') ? session('cart.inc_dl') : 0,
            'weight' => $cartWeight,
            'message' => 'Cart Updated'
        ];
    }
}
