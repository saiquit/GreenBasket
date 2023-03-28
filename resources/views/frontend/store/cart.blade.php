@extends('layouts.frontend.base')

@section('main')
    <div class="hero-wrap hero-bread py-4" style="background-image: url('/static/frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center fadeInUp ftco-animated">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>Image</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="cart_table">
                                @if (session('cart.items'))
                                    @foreach (session('cart.items') as $variation)
                                        <tr class="text-center" data-id="{{ $variation->id }}">
                                            <td class="product-remove"><a class="border-danger bg-danger text-white"
                                                    href="{{ route('cart.delete', ['id' => $variation->id]) }}"><span
                                                        class="ion-ios-close"></span></a>
                                            </td>
                                            <td class="image-prod zoom-box">
                                                <div class="" {{-- style="background-image:url(/static/frontend/images/product-3.jpg);" --}}>
                                                    <img class="product_img"
                                                        src="/static/frontend/images/product-{{ rand(1, 10) }}.jpg"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td class="product-name">
                                                <h3>{{ $variation['name_' . app()->getLocale()] }}</h3>
                                                <p><b>SKU: </b>{{ $variation->sku }} <br><span><b>Weight:
                                                        </b>{{ $variation->weight }} Kg</span></p>
                                            </td>
                                            <td class="price">
                                                <sup><del class="text-muted">${{ $variation->price->discount_percent }}
                                                        ৳</del></sup>
                                                {{ $variation->price->price }}৳
                                            </td>
                                            <td class="quantity">
                                                <div class="input-group mb-3">
                                                    <div id="quatity_choice"
                                                        class="input-group col-md-6 d-flex mb-3 flex-nowrap">
                                                        <span class="input-group-btn mr-2">
                                                            <button type="button" class="quantity-left-minus btn"
                                                                data-type="minus" data-field="{{ $variation->id }}"
                                                                @if (session('cart.items')[$variation->id]['qty'] == 1) disabled="disabled" @endif>
                                                                <i class="ion-ios-remove"></i>
                                                            </button>
                                                        </span>
                                                        <input type="text" readonly id="quantity_{{ $variation->id }}"
                                                            name="quantity" style="width: 4rem"
                                                            class="form-control input-number"
                                                            value="{{ isset(session('cart.items')[$variation->id]['qty']) ? session('cart.items')[$variation->id]['qty'] : 0 }}"
                                                            min="1" max="99">
                                                        <span class="input-group-btn ml-2">
                                                            <button type="button" class="quantity-right-plus btn"
                                                                data-type="plus" data-field="{{ $variation->id }}">
                                                                <i class="ion-ios-add"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td id="price_{{ $variation->id }}"
                                                data-price="{{ $variation->price->price }}" class="total">
                                                {{ isset(session('cart.items')[$variation->id]['qty']) ? session('cart.items')[$variation->id]['qty'] * $variation->price->price : 0 }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center display-4 w-100">Cart Empty!</div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
                    <div class="cart-total mb-3">
                        <h3>Coupon Code</h3>
                        <p>Enter your coupon code if you have one</p>
                        <form action="#" class="info">
                            <div class="form-group">
                                <label for="">Coupon code</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                        </form>
                    </div>
                    <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
                </div>
                {{-- <div class="col-lg-4 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
                    <div class="cart-total mb-3">
                        <h3>Estimate shipping and tax</h3>
                        <p>Enter your destination to get a shipping estimate</p>
                        <form action="{{ route('cart.calculateDelivery') }}" method="POST" id="estimate_delivery"
                            class="info">
                            @csrf
                            <div class="form-group">
                                <label for="country">Division</label>
                                <select name="district" id="" class="form-control left-left px-3">
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" @selected($division->id == session('selectedId'))>
                                            {{ $division['name_' . app()->getLocale()] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="country">Zip/Postal Code</label>
                                <input name="zip" type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <button type="submit" id="estimate_btn"
                                class="btn btn-primary text-white py-3 px-4">Estimate</button>
                        </form>
                    </div>
                </div> --}}
                <div class="col-lg-8 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span id="subTotal_amount">${{ session('cart.subTotal') }}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span id="delivery_cost">$
                                @if (session()->has('cart.base_dl'))
                                    {{ session('cart.base_dl') . ' + ' . (floatVal(session('cart.weight')) - 1) * floatVal(request()->districts->find(session('cart.district_id'))['increment_cost']) }}
                                @else
                                    "0.00"
                                @endif
                            </span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span id="delivery_cost">$0.00</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span style="display: inline-flex;">$ <span
                                    id="total_cost">{{ session('cart.subTotal') + session('cart.base_dl') + (floatVal(session('cart.weight')) - 1) * floatVal(request()->districts->find(session('cart.district_id'))['increment_cost']) }}</span></span>
                        </p>
                    </div>
                    <p class="text-right">
                        <a href="{{ route('front.checkout') }}" class="btn btn-primary py-3 px-4"> Proceed to
                            Checkout</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(function() {

        });
    </script>
@endpush
