<header id="wn__header" class="header__area header__absolute sticky__header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo/logo.png') }}" alt="logo images">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li class="drop with--one--item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="drop"><a href="/books">Books</a>
                            <div class="megamenu mega03">
                                <ul class="item item03">
                                    <li><a class="title" href="/loaisachs">Categories</a></li>
                                    <li><a href="/loaisachs/1">truyện cười </a></li>
                                    <li><a href="/loaisachs/2">truyện trinh thám </a></li>
                                    <li><a href="/loaisachs/3">truyện cổ tích </a></li>
                                    <li><a href="/loaisachs/4">truyện ngụ ngôn </a></li>
                                    <li><a href="/loaisachs/5">sách tâm lý </a></li>
                                </ul>
                                <ul class="item item03">
                                    <li><a class="title">Customer Favourite</a></li>
                                    <li><a href="#">Mystery</a></li>
                                    <li><a href="#">Religion & Inspiration</a></li>
                                    <li><a href="#">Romance</a></li>
                                    <li><a href="#">Fiction/Fantasy</a></li>
                                    <li><a href="#">Sleeveless</a></li>
                                </ul>
                                <ul class="item item03">
                                    <li><a class="title">Collections</a></li>
                                    <li><a href="#">Science </a></li>
                                    <li><a href="#">Fiction/Fantasy</a></li>
                                    <li><a href="#">Self-Improvemen</a></li>
                                    <li><a href="#">Home & Garden</a></li>
                                    <li><a href="#">Humor Books</a></li>
                                </ul>
                            </div>
                        </li>

                        @canany(['admin','staff'])
                            <li><a href="{{ route('loaisachs.index') }}">Book Type</a></li>
                        @endcanany
                        <li><a href="{{ route('tacgias.index') }}">Tac Gia</a></li>
                        <li><a href="{{ route('nhaxuatbans.index') }}">Nha Xuat Ban</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li class="shop_search"><a class="search__active" href="#"></a></li>
                    <li class="wishlist"><a href="#"></a></li>
                    <li class="shopcart"><a class="" href="{{ route('carts.index') }}"></a></li>
                    <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                        <div class="searchbar__content setting__block">
                            <div class="content-inner">
                                <div class="switcher-currency">
                                    @guest()
                                        <a class="label switcher-label" href="{{ route('login') }}">
                                            <span>Sign In</span>
                                        </a>
                                        <a class="label switcher-label" href="{{ route('register') }}">
                                            <span>Register</span>
                                        </a>
                                    @else
                                        <strong class="label switcher-label">
                                            <span>{{ Auth::user()->name }}</span>
                                        </strong>
                                        <div class="switcher-options">
                                            <div class="switcher-currency-trigger">
                                                @canany(['admin','staff'])
                                                    <a class="currency-trigger" href="{{ route('users.index') }}">Manager</a>
                                                @endcanany
                                                <a class="currency-trigger" href="{{ route('users.show',Auth::user()->id) }}">Your Profile</a>
                                                <a class="currency-trigger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    @endguest
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Start Mobile Menu -->
        <div class="row d-none">
            <div class="col-lg-12 d-none">
                <nav class="mobilemenu__nav">
                    <ul class="meninmenu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">Pages</a>
                            <ul>
                                <li><a href="about.html">About Page</a></li>
                                <li><a href="portfolio.html">Portfolio</a>
                                    <ul>
                                        <li><a href="portfolio.html">Portfolio</a></li>
                                        <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="cart.html">Cart Page</a></li>
                                <li><a href="checkout.html">Checkout Page</a></li>
                                <li><a href="wishlist.html">Wishlist Page</a></li>
                                <li><a href="error404.html">404 Page</a></li>
                                <li><a href="faq.html">Faq Page</a></li>
                                <li><a href="team.html">Team Page</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Shop</a>
                            <ul>
                                <li><a href="#">Shop Grid</a></li>
                                <li><a href="single-product.html">Single Product</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.html">Blog</a>
                            <ul>
                                <li><a href="blog.html">Blog Page</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Mobile Menu -->
        <div class="mobile-menu d-block d-lg-none">
        </div>
        <!-- Mobile Menu -->
    </div>
</header>

<!-- Start Search Popup -->
<div class="brown--color box-search-content search_active block-bg close__top">
    <form id="search_mini_form" class="minisearch" action="{{ route('books.index') }}">
        <div class="field__search">
            <div class="row">
                <div class="col-auto">
                    <input class="form-control mr-sm-0" type="search" placeholder="book name" name="name" value="{{ request('name') }}">
                </div>
                <div class="col-auto">
                    <input class="form-control mr-sm-0" type="number" placeholder="min price" name="min_price" value="{{ request('min_price') }}">
                </div>
                <div class="col-auto">
                    <input class="form-control mr-sm-0" type="number" placeholder="max price" name="max_price" value="{{ request('max_price') }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-auto">
                    <select class="browser-default custom-select mr-sm-0" name="loaisach_id">
                        <option value="">book type</option>
                        @foreach(\App\Models\Loaisach::pluck('name', 'id')->toArray() as $key => $value)
                            <option value="{{ $key }}" {{ ((request('loaisach_id') ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <select class="browser-default custom-select mr-sm-0" name="tacgia_id">
                        <option value="">Tac gia</option>
                        @foreach(\App\Models\tacgia::pluck('name', 'id')->toArray() as $key => $value)
                            <option value="{{ $key }}" {{ ((request('tacgia_id') ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <select class="browser-default custom-select mr-sm-0" name="nhaxuatban_id">
                        <option value="">Nha xuat ban</option>
                        @foreach(\App\Models\Nhaxuatban::pluck('name', 'id')->toArray() as $key => $value)
                            <option value="{{ $key }}" {{ ((request('nhaxuatban_id') ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-primary my-2 my-sm-10 container d-flex justify-content-center" type="submit">Search</button>
        </div>
    </form>
    <div class="close__wrap">
        <span>close</span>
    </div>
</div>
<!-- End Search Popup -->
<!-- Start Slider area -->
<div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
    <!-- Start Single Slide -->
    <div class="slide animation__style10 bg-image--1 fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <h2>Buy <span>your </span></h2>
                            <h2>favourite <span>Book </span></h2>
                            <h2>from <span>Here </span></h2>
                            {{--                            <a class="shopbtn" href="#">shop now</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->
    <!-- Start Single Slide -->
    <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <h2>Buy <span>your </span></h2>
                            <h2>favourite <span>Book </span></h2>
                            <h2>from <span>Here </span></h2>
                            {{--                            <a class="shopbtn" href="#">shop now</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->
</div>
<!-- End Slider area -->
