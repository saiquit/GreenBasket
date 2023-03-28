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
            <div class="col-md-4 d-flex align-items-center"></div>
            <div class="col-md-8">
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item "><a href="{{ route('front.home', ['lang' => app()->getLocale()]) }}"
                                class="nav-link">Home</a>
                        </li>
                        <li class="nav-item "><a href="{{ route('front.store', ['lang' => app()->getLocale()]) }}"
                                class="nav-link">Store</a>
                        </li>

                        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>

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

                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>
