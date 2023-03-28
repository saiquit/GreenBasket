@extends('layouts.frontend.base')

@section('main')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px"
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                        class="font-weight-bold">{{ Str::ucfirst($profile->first_name) . ' ' . $profile->sur_name }}</span><span
                        class="text-black-50">{{ auth()->user()->email }}</span><span>
                    </span>
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link btn active" id="v-pills-profile-tab" data-toggle="pill"
                        data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">Profile</button>
                    <button class="nav-link btn" id="v-pills-orders-tab" data-toggle="pill" data-target="#v-pills-orders"
                        type="button" role="tab" aria-controls="v-pills-orders" aria-selected="false">Orders</button>
                </div>

            </div>
            <div class="col-md-9 ">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade " id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile">
                        <form action="{{ route('profile.update', []) }}" method="post">
                            @csrf
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Profile Settings</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">Name</label>
                                        <input name="first_name" type="text" class="form-control"
                                            placeholder="first name"
                                            value="{{ $profile->first_name ? $profile->first_name : old('first_name') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Surname</label>
                                        <input type="text" name="sur_name" class="form-control"
                                            value="{{ $profile->sur_name ? $profile->sur_name : old('sur_name') }}"
                                            placeholder="surname">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 ">
                                        <label class="labels">Mobile Number</label>
                                        <input type="text" disabled readonly value="{{ $profile->user->phone }}"
                                            class="form-control" placeholder="enter phone number" value="">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Address </label>
                                        <input name="address" type="text" class="form-control"
                                            placeholder="enter address line 1"
                                            value="{{ $profile->address ? $profile->address : old('address') }}">
                                    </div>

                                    <div class="col-md-12"><label class="labels">Postcode</label><input type="text"
                                            name="post" class="form-control" placeholder="enter address line 2"
                                            value="{{ $profile->post ? $profile->post : old('post') }}">
                                    </div>
                                    <div class="col-md-12"><label class="labels">District</label>
                                        <div class="form-group">
                                            <select name="district" class="form-control">
                                                @foreach (request()->districts as $district)
                                                    <option value="{{ $district['id'] }}" @selected($district['id'] == $profile->district)>
                                                        {{ $district['name_en'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <input type="text" class="form-control" name="district"
                                            placeholder="enter address line 2"
                                            value="{{ $profile->district ? $profile->district : old('district') }}"> --}}
                                    </div>
                                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text"
                                            name="email" class="form-control" placeholder="enter email id"
                                            value="{{ $profile->user->email ? $profile->user->email : '' }}"></div>
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                                    <button class="btn btn-danger profile-button"
                                        onclick="event.preventDefault(); document.querySelector('#logout').submit();">
                                        <i class="icon icon-sign-out"></i> Log out</button>
                                </div>
                            </div>
                        </form>
                        <form id="logout" action="{{ route('auth.logout') }}" hidden method="POST">
                            @csrf
                        </form>
                    </div>
                    <div class="tab-pane fade show active" id="v-pills-orders" role="tabpanel"
                        aria-labelledby="v-pills-orders-tab">
                        @foreach (auth()->user()->orders->sortByDesc('created_at')->slice(0, 5) as $order)
                            <div class="row no-gutters border p-2 rounded my-2">
                                <div class="col-md-12">
                                    <div class="cart-header d-flex justify-content-between">
                                        <h4 class="card-title">#{{ $order->order_id }}</h4>
                                        <p
                                            class="badge p-2 @if ($order->payment == 'pending') badge-warning @else badge-success @endif">
                                            {{ $order->payment }}</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title">
                                                <div>Reciver Name: {{ $order->first_name . ' ' . $order->sur_name }}</div>
                                            </h5>
                                            <p class="card-text"><b>Total: ${{ $order->total }}</b></p>
                                        </div>
                                        <p class="card-text text-right"><small
                                                class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                        </p>

                                        <div class="list-group">
                                            @foreach ($order->variations as $variation)
                                                <a href="#" class="list-group-item list-group-item-action ">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1">{{ $variation['name_' . app()->getLocale()] }}
                                                        </h5>
                                                        <p><b>${{ $variation->price->price }}</b></p>
                                                    </div>
                                                    <p class="mb-1">Weight: {{ $variation->weight }} KG</p>
                                                    <small>And some small print.</small>
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="my-4">
                                            @if ($order->payment == 'pending')
                                                <a class="btn btn-primary float-right mx-2" href="">Pay Now</a>
                                            @endif
                                            <a class="btn btn-secondary float-right mx-2"
                                                href="{{ route('payment.invoice', $order->order_id) }}">Print Invoice</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">...</div>
                </div>


            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
