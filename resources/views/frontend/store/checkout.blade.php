@extends('layouts.frontend.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('static/frontend/css/checkout.css') }}">
@endpush
@section('main')
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input
                                            value="{{ isset(auth()->user()->profile->first_name) ? auth()->user()->profile->first_name : old('first_name') }}"
                                            name="first_name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Sur Name<span>*</span></p>
                                        <input
                                            value="{{ isset(auth()->user()->profile->sur_name) ? auth()->user()->profile->sur_name : old('sur_name') }}"
                                            name="sur_name" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address"
                                    class="checkout__input__add"
                                    value="{{ isset(auth()->user()->profile->address) ? auth()->user()->profile->address : old('address') }}">
                            </div>
                            <div class="checkout__input">
                                <p>District<span>*</span></p>
                                <select name="district" class="form-control">
                                    @foreach (request()->districts as $district)
                                        <option @if ($district['id'] == session('cart.district_id')) selected @endif
                                            value="{{ $district['id'] }}">
                                            {{ $district['name_en'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input
                                    value="{{ isset(auth()->user()->profile->post) ? auth()->user()->profile->post : old('post') }}"
                                    name="post" type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input value=" @auth {{ auth()->user()->phone }} @endauth " name="phone"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input
                                            value="{{ isset(auth()->user()->email) ? auth()->user()->email : old('email') }}"
                                            name="email" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div id="diff-add">
                                <div class="checkout__input">
                                    <p>District<span>*</span></p>
                                    <select name="diff_district" class="form-control">
                                        <option selected disabled>None</option>
                                        @foreach (request()->districts as $district)
                                            <option value="{{ $district['id'] }}">
                                                {{ $district['name_en'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="checkout__input">
                                    <p>Shipping Address<span>*</span></p>
                                    <input type="text" name="diff_address" placeholder="Street Address"
                                        class="checkout__input__add" value="">
                                </div>
                            </div>
                            {{-- <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div> --}}
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul class="p-0">
                                    @foreach (session('cart.items') as $variation)
                                        <li>{{ $variation['name_' . app()->getLocale()] . ' x ' . $variation['qty'] }}
                                            <span>${{ $variation->price->price . ' x ' . $variation['qty'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal
                                    <span>${{ session('cart.subTotal') }}</span>
                                    <div class="checkout__order__subtotal">Delivery
                                        <span>${{ $delivery_cost }}</span>
                                    </div>
                                    <div class="checkout__order__total">Total <span>${{ $total }}</span></div>


                                    <fieldset>
                                        <legend>Choose a Payment Method</legend>
                                        <div class="radio-item-container">
                                            <div class="radio-item">
                                                <label for="vanilla">
                                                    <input type="radio" id="vanilla" name="payment_method"
                                                        value="bkash">
                                                    <span>Bkash<span class="icon"><img width="80"
                                                                src="https://www.logo.wine/a/logo/BKash/BKash-Icon-Logo.wine.svg"
                                                                alt="" srcset=""></span> </span>
                                                </label>
                                            </div>

                                            <div class="radio-item">
                                                <label for="chocolate">
                                                    <input type="radio" id="chocolate" name="payment_method"
                                                        value="nagad">
                                                    <span>Nagad <span class="icon"><img width="80"
                                                                src="https://www.logo.wine/a/logo/Nagad/Nagad-Logo.wine.svg"
                                                                alt=""></span></span></label>
                                            </div>

                                            <div class="radio-item">
                                                <label for="strawberry">
                                                    <input type="radio" id="strawberry" name="payment_method"
                                                        value="cod">
                                                    <span>Cash on Delivert <span class="icon"><img
                                                                src="https://cdn-icons-png.flaticon.com/512/5129/5129212.png"
                                                                width="80" alt=""></span></span></label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div> <button type="submit" class="btn site-btn btn-black">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(function() {
            $('#diff-add').hide();
            $('#create_acc_div').hide()
            $('#diff-acc').change(function(e) {
                e.preventDefault();
                if ($(this).is(':checked')) {
                    // console.log($('#diff-add'));
                    $('#diff-add').show();
                } else {
                    $('#diff-add').hide();

                };
            })
            $("input[name='create_acc']").change(function(e) {
                e.preventDefault();
                if ($(this).is(':checked')) {
                    // console.log($('#diff-add'));
                    $('#create_acc_div').show();
                } else {
                    $('#create_acc_div').hide();

                };
            })
            $("select[name='district']").change(function(e) {
                e.preventDefault();
                $.post("{{ route('cart.calculateDelivery') }}", {
                        "district": $(this).val(),
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    function(data, textStatus, xhr) {
                        if (xhr.status == 200) {
                            location.reload();
                        }
                    }
                );

            });

        });
    </script>
@endpush
