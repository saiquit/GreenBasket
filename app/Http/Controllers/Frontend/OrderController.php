<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCost;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'string',
            'sur_name' => 'string',
            'phone' => 'string|required|digits:11',
            'email' => 'required|email',
            'district' => 'string',
            'address' => 'string',
            'post' => 'string',
            'payment_method' => 'required'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if (isset($request->diff_district)) {
            $district = DeliveryCost::find($request->diff_district);
        } else {
            $district = DeliveryCost::find($request->district);
        }

        $qty_total = session('cart.qty');
        $wt_total = session('cart.weight');
        $sub_total = session('cart.subTotal');
        $base_dl = $district['base_cost'];
        $inc_dl = $district['increment_cost'];
        $dl_total =  $base_dl + floatval($wt_total - 1) * $inc_dl;
        $total = $sub_total + $dl_total;
        $order_count = Order::whereMonth('created_at', Carbon::now()->month)->count();


        $order = Order::create([
            'order_id' => date('ym') . sprintf("%04d", $order_count + 1),
            'user_id' => auth()->id(),
            'total' => $total,
            'qty_total' => $qty_total,
            'sub_total' => $sub_total,
            'dl_total' => $dl_total,
            'wt_total' => $wt_total,
            'payment_method' => $request->payment_method,
            'phone' => $request->phone,
            'first_name' => $request->first_name,
            'sur_name' => $request->sur_name,
            'district' => $request->district,
            'address' => $request->address,
            'post' => $request->post,
            'email' => $request->email,
            'diff_district' => isset($request->diff_district) ? $request->diff_district : null,
            'diff_address' => isset($request->diff_address) ? $request->diff_address : null,

        ]);
        foreach (session('cart.items') as $key => $item) {
            // dd($order);
            $order->variations()->attach($item['id'], [
                'qty' => $item['qty'],
                'wt'  => $item['qty'] * $item['weight']
            ]);
        }
        session()->forget(['cart.items', 'cart.qty', 'cart.weight', 'cart.subTotal']);
        return redirect()->route('payment.invoice', $order->order_id);
    }
}
