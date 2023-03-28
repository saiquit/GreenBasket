@extends('layouts.frontend.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('static/frontend/css/jquery.jqZoom.css') }}">
@endpush
@section('main')
    <div class="hero-wrap hero-bread py-4" style="background-image: url('/static/frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span class="mr-2"><a
                                href="{{ route('front.store') }}">Store</a></span>
                        <span>{{ $product['name_' . app()->getLocale()] }}</span>
                    </p>
                    <h1 class="mb-0 bread">{{ $product['name_' . app()->getLocale()] }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container-fluid">
            <div class="row px-3">
                <div class="col-lg-4 mb-5 ftco-animate ">
                    <a href="/static/frontend/images/product-{{ rand(1, 10) }}.jpg" class="image-popup"><img
                            src="/static/frontend/images/product-{{ rand(1, 10) }}.jpg" class="img-fluid "
                            alt=""></a>
                    <h3>{{ $product['name_' . app()->getLocale()] }}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span
                                    style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">500 <span
                                    style="color: #bbb;">Sold</span></a>
                        </p>
                    </div>
                    <p>{{ $product['desc_' . app()->getLocale()] }}
                    </p>
                </div>
                <div class="col-lg-8 product-details pl-md-5 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Image</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($product->variations->count())
                                    @foreach ($product->variations as $variation)
                                        <tr class="text-center">
                                            <td class="image-prod zoom-box">
                                                <div class="" {{-- style="background-image:url(/static/frontend/images/product-3.jpg);" --}}>
                                                    <img class="product_img"
                                                        src="/static/frontend/images/product-{{ rand(1, 10) }}.jpg"
                                                        alt="" width="200px">
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
                                                            <button @disabled(!isset(session('cart.items')[$variation->id])) type="button"
                                                                class="quantity-left-minus btn" data-type="minus"
                                                                data-field="{{ $variation->id }}">
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
                                        </tr><!-- END TR-->
                                    @endforeach
                                @else
                                    <div class="alert alert-danger w-100">No Products Uploded!</div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Products</span>
                    <h2 class="mb-4">Related Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="/static/frontend/images/product-1.jpg" alt="Colorlib Template">
                            <span class="status">30%</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">Bell Pepper</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="mr-2 price-dc">$120.00</span><span
                                            class="price-sale">$80.00</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#"
                                        class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="#"
                                        class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="/static/frontend/images/product-2.jpg" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">Strawberry</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>$120.00</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#"
                                        class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="#"
                                        class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="/static/frontend/images/product-3.jpg" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">Green Beans</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>$120.00</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#"
                                        class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="#"
                                        class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="/static/frontend/images/product-4.jpg" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">Purple Cabbage</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>$120.00</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#"
                                        class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="#"
                                        class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('static/frontend/js/jquery.jqZoom.js') }}"></script>
    <script>
        $(document).ready(function() {
            // zoom
            $(".product_img").jqZoom({
                selectorWidth: 30,
                selectorHeight: 30,
                viewerWidth: 400,
                viewerHeight: 400,
            });
        })
    </script>
@endpush
