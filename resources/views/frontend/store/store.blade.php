@extends('layouts.frontend.base')

@section('main')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('static/frontend/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
                    <h1 class="mb-0 bread">Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="{{ route('front.store', ['lang' => app()->getLocale()]) }}"
                                class="@if (!request()->has('cat')) active @endif">All</a></li>

                        @foreach ($categories_list as $category)
                            <li><a class="@if (request()->cat == $category->id) active @endif"
                                    href="{{ route('front.store', ['cat' => $category->id, 'lang' => app()->getLocale()]) }}">{{ Str::ucfirst($category['name_' . app()->getLocale()]) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                @if ($products->count())
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-3 ftco-animate">
                            <div class="product">
                                <a href="{{ route('front.single', ['slug' => $product->slug, 'lang' => app()->getLocale()]) }}"
                                    class="img-prod"><img class="img-fluid"
                                        src="{{ asset('static/frontend/images/product-' . rand(1, 10) . '.jpg') }}"
                                        alt="Colorlib Template">
                                    <span class="status">{{ $product->variations[0]->price->discount_percent }}%</span>
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a
                                            href="{{ route('front.single', ['slug' => $product->slug, 'lang' => app()->getLocale()]) }}">{{ $product['name_' . app()->getLocale()] }}</a>
                                    </h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price"><span
                                                    class="mr-2 price-dc">${{ $product->variations[0]->price->price }}</span><span
                                                    class="price-sale">${{ $product->variations[0]->price->discount_price }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            <a href="{{ route('front.single', ['slug' => $product->slug, 'lang' => app()->getLocale()]) }}"
                                                class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                                <span><i class="ion-ios-menu"></i></span>
                                            </a>
                                            <a onclick="window.document.querySelector('#add_cart_{{ $product->id }}').submit();"
                                                class="buy-now d-flex justify-content-center align-items-center mx-1">
                                                <span><i class="ion-ios-cart"></i></span>
                                            </a>
                                            <form hidden id="add_cart_{{ $product->id }}"
                                                action="{{ route('cart.add', ['id' => $product->variations[0]->id]) }}"
                                                method="post">
                                                @csrf
                                            </form>
                                            <a href="#"
                                                class="heart d-flex justify-content-center align-items-center ">
                                                <span><i class="ion-ios-heart"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger w-100 text-center">Nothing Uploded Yet</div>
                @endisset
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                {{ $products->appends($_GET)->links('pagination::custom') }}
            </div>
        </div>
    </div>
</section>
@endsection
