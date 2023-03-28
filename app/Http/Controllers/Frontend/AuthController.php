<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('language')->except(['do_login', 'do_register', 'do_phone_verification', 'do_set_password', 'do_forgot_password', 'logout']);
    }
    public function show_login(Request $request)
    {
        return view('auth.login');
    }
    public function do_login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => 'required|regex:/[0-9]{11}/|digits:11',
            'password' => 'required|string',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        if (auth()->attempt(['phone' => $request->input('phone'), 'password' => $request->input('password')], $request->remember)) {
            $district = isset(auth()->user()->profile->district) ? auth()->user()->profile->district : DeliveryCost::where('id', 1)->first()->id;
            $cost = isset($district) ? floatval(DeliveryCost::where('id', $district)->first()->base_cost) : floatval(DeliveryCost::where('1', $district)->first()->base_cost);
            $inc_cost =  floatval(DeliveryCost::where('id', $district)->first()->increment_cost);
            session()->put('cart.base_dl', $cost);
            session()->put('cart.inc_dl', $inc_cost);
            session()->put('cart.district_id', $district);
            // return redirect()->route('profile.index');
            return redirect()->intended();
        } else {
            // $request->session()->flash('message', 'No User Found');
            return redirect()->back()->with(['message' => 'No User Found on ' . $request->phone, 'alert-type' => 'error']);
        }
    }
    public function show_register(Request $request)
    {
        return view('auth.register');
    }
    public function do_register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => 'required|regex:/[0-9]{11}/|digits:11'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        } else {
            $user = User::where('phone', $request->phone)->first();
            if ($user and $user->verified) {
                return redirect()->route('auth.login');
            }
            if (!$request->session()->has('verification_code')) {
                $verification_code = rand(10000, 99999);
                $request->session()->put('verification_code', $verification_code);
            }
            if (!$user) {
                $user = User::create([
                    'phone' => $request->phone,
                    'verified' => false,
                ]);
            }
            return  view('auth.phone_verify', compact('user'));
        }
    }
    public function do_phone_verification(Request $request)
    {
        $validate_code = Validator::make($request->all(), [
            'v_number' => 'required|regex:/[0-9]{5}/|digits:5',
            'user'     => 'required',
        ]);
        $user = User::findOrFail($request->user);
        if ($validate_code->fails()) {
            return view('auth.phone_verify', ['user' => $user, 'error' => $validate_code->messages()->all()[0]]);
        } else {
            if (!$request->session()->has('verification_code')) {
                return view('auth.phone_verify', ['user' => $user, 'error' => 'Session Lost!']);
            } else {
                if ($request->v_number == $request->session()->get('verification_code')) {
                    $user->verified = true;
                    $user->save();
                    auth()->login($user);
                    // dd(auth()->user());
                    $request->session()->forget('verification_code');
                    return redirect()->route('auth.set_password');
                } else {
                    return  view('auth.phone_verify', ['user' => $user, 'error' => "Wrong! Try Again"]);
                }
            }
        }
    }

    public function set_password(Request $request)
    {
        $user = auth()->user();
        return view('auth.set_password', compact('user'));
    }
    public function do_set_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        $user = auth()->user();
        // dd($user);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        } else {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->route('profile.index');
        }

        // $user->update([]);
    }
    public function show_forgot(Request $request)
    {
        return view('auth.passwords.forget');
    }

    public function do_forgot_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => 'required|regex:/[0-9]{11}/|digits:11'
        ]);
        if ($validate->fails()) {
            // dd($validate->messages());
            return redirect()->back()->withErrors($validate);
        } else {
            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return redirect()->back()->with(['message' => 'No User Found', 'alert-type' => 'error']);
            } else {
                if (!$request->session()->has('verification_code')) {
                    $verification_code = rand(10000, 99999);
                    $request->session()->put('verification_code', $verification_code);
                }
                return view('auth.phone_verify', compact('user'));
            }
        }
    }
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');
    }
}
