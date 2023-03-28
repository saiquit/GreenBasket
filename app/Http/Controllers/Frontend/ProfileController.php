<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('additional')->except(['updateProfile']);
        $this->middleware('language')->except(['updateProfile']);
    }
    public function index(Request $request)
    {
        $user = auth()->user();
        if (!$user->password) {
            return redirect()->route('auth.set_password');
        }
        $profile = Profile::firstOrNew(['user_id' => auth()->id()]);
        return view('frontend.profile.view', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'max:100',
            'sur_name' => 'max:100',
            'address' => 'max:100',
            'district' => 'max:100',
            'post' => 'max:100',
        ]);
        if ($validate->fails()) {
            return  redirect()->back()->withErrors($validate);
        }
        $user = auth()->user();
        $profile = Profile::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'first_name' => $request->first_name,
            'sur_name' => $request->sur_name,
            'address' => $request->address,
            'district' => $request->district,
            'post' => $request->post,
        ]);
        if ($request->has('email')) {
            $user->update([
                'email' => $request->email
            ]);
        }
        return redirect()->back()->with('profile', $profile);
    }
}
