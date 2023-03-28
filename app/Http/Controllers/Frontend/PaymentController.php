<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function invoice(Request $request, $id)
    {
        $order = Order::where('order_id', $id)->first();
        if (auth()->user()->id == $order->user_id) {
            return view('frontend.payment.invoice', compact('order'));
        } else {
            return redirect()->route('front.home')->with(['message', 'Invalid']);
        }
    }
}
