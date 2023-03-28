<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                class="icon-phone2"></span></div>
                        <span class="text">+ 1235 2355 98</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                class="icon-paper-plane"></span></div>
                        <span class="text">youremail@email.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">3-5 Business days delivery &amp; Free Returns</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div id="" class="container d-flex flex-column mt-4">
        <div class="row w-100">
            <div class="col-6 col-md-8 d-flex align-items-center">
                <button class="navbar-toggler pr-3" type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span>
                </button>
                <a class="navbar-brand" href="{{ route('front.home', ['lang' => app()->getLocale()]) }}">
                    <img src="{{ asset('static/frontend/images/greenbasket_light.png') }}" alt="logo">
                </a>

            </div>
            <div class="col-6 col-md-4 ">
                <div class="form-group">
                    <div class="search-container float-right">
                        <form action="/search" method="get">
                            <input class="search expandright" id="searchright" type="search" name="q"
                                placeholder="Search">
                            <label class="button searchbutton" for="searchright"><span
                                    class="mglass">&#9906;</span></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100">
            <div class="col-md-3 d-flex align-items-center">
                <p class="mt-3" style="line-height: 0">
                    <a class="category_btn" data-toggle="collapse" href="#category_list" role="button"
                        aria-expanded="false" aria-controls="category_list">
                        <span class="icon icon-list2"></span> All Categories
                    </a>

                </p>
                <div class="collapse absoulute border" id="category_list">
                    @foreach (request()->categories as $category)
                        @if ($category->subcategory->count())
                            <div class="nav bg-white">
                                <a class="nav-link "
                                    href="{{ route('front.single_category', ['slug' => $category->slug, 'lang' => app()->getLocale()]) }}">
                                    <span class="icon icon-shopping-cart"></span>
                                    {{ Str::ucfirst($category['name_' . app()->getLocale()]) }}
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item "><a href="{{ route('front.home', ['lang' => app()->getLocale()]) }}"
                                class="nav-link">Home</a>
                        </li>
                        <li class="nav-item "><a href="{{ route('front.store', ['lang' => app()->getLocale()]) }}"
                                class="nav-link">Store</a>
                        </li>

                        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                        <li class="nav-item text-mute"><a href="#" data-toggle="modal"
                                data-target="#selectDistrict" class="nav-link">
                                @if (session('cart.district_id'))
                                    {{-- {{ session('cart.district_id') }} --}}
                                    <span class="text-primary">
                                        <i class="icon icon-my_location"></i>
                                        {{ request()->districts->find(session('cart.district_id'))['name_' . app()->getLocale()] }}
                                    </span>
                                @else
                                    <i class="icon icon-location_searching"></i>
                                    {{-- District --}}
                                @endif
                            </a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{ session('locale') }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                @foreach (Config::get('app.available_locales') as $key => $lang)
                                    <a class="dropdown-item text-uppercase"
                                        href="
                                    @if (Route::currentRouteName() == 'front.single') {{ route(Route::currentRouteName(), ['slug' => request()->slug, 'lang' => $lang]) }}
                                    @else
                                    {{ route(Route::currentRouteName(), ['lang' => $lang]) }} @endif
                                    ">{{ $key }}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item d-flex align-items-center px-2">
                            @auth
                                <a href="{{ route('profile.index', []) }}">
                                    <button class="btn btn-primary">
                                        <i class="icon icon-verified_user"></i> Profile
                                    </button>
                                </a>
                            @else
                                <a href="{{ route('auth.login', []) }}">
                                    <button class="btn btn-primary">
                                        <i class="icon icon-lock"></i> Login
                                    </button>
                                </a>
                            @endauth
                        </li>
                        <li class="nav-item cta cta-colored"><a href="{{ route('front.cart') }}"
                                class="nav-link"><span class="icon-shopping_cart"></span>[<span
                                    id="cart_val">{{ session('cart.items') ? count(session('cart.items')) : 0 }}</span>]</a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>
