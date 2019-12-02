<header id="wn__header" class="header__area header__absolute sticky__header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <div class="logo">
                    <a href="index.html">
                        <img src="{{ asset('img/logo/logo.png') }}" alt="logo images">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li class="drop with--one--item"><a href="index.html">Home</a></li>

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

                        <li><a href="#">Tac Gia</a></li>
                        <li><a href="#">Nha Xuat Ban</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li class="shop_search"><a class="search__active" href="#"></a></li>
                    <li class="wishlist"><a href="#"></a></li>
                    <li class="shopcart"><a class="cartbox_active" href="#">
{{--                            <span class="product_qun">4</span>--}}
                        </a>
                        <!-- Start Shopping Cart -->
{{--                        <div class="block-minicart minicart__active">--}}
{{--                            <div class="minicart-content-wrapper">--}}
{{--                                <div class="micart__close">--}}
{{--                                    <span>close</span>--}}
{{--                                </div>--}}
{{--                                <div class="items-total d-flex justify-content-between">--}}
{{--                                    <span>3 items</span>--}}
{{--                                    <span>Cart Subtotal</span>--}}
{{--                                </div>--}}
{{--                                <div class="total_amount text-right">--}}
{{--                                    <span>$66.00</span>--}}
{{--                                </div>--}}
{{--                                <div class="mini_action checkout">--}}
{{--                                    <a class="checkout__btn" href="cart.html">Go to Checkout</a>--}}
{{--                                </div>--}}
{{--                                <div class="single__items">--}}
{{--                                    <div class="miniproduct">--}}
{{--                                        <div class="item01 d-flex">--}}
{{--                                            <div class="thumb">--}}
{{--                                                <a href="product-details.html"><img src="{{ asset('img/product/sm-img/1.jpg') }}" alt="product images"></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="content">--}}
{{--                                                <h6><a href="product-details.html">Voyage Yoga Bag</a></h6>--}}
{{--                                                <span class="prize">$30.00</span>--}}
{{--                                                <div class="product_prize d-flex justify-content-between">--}}
{{--                                                    <span class="qun">Qty: 01</span>--}}
{{--                                                    <ul class="d-flex justify-content-end">--}}
{{--                                                        <li><a href="#"><i class="zmdi zmdi-settings"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="zmdi zmdi-delete"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="item01 d-flex mt--20">--}}
{{--                                            <div class="thumb">--}}
{{--                                                <a href="product-details.html"><img src="{{ asset('img/product/sm-img/3.jpg') }}" alt="product images"></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="content">--}}
{{--                                                <h6><a href="product-details.html">Impulse Duffle</a></h6>--}}
{{--                                                <span class="prize">$40.00</span>--}}
{{--                                                <div class="product_prize d-flex justify-content-between">--}}
{{--                                                    <span class="qun">Qty: 03</span>--}}
{{--                                                    <ul class="d-flex justify-content-end">--}}
{{--                                                        <li><a href="#"><i class="zmdi zmdi-settings"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="zmdi zmdi-delete"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="item01 d-flex mt--20">--}}
{{--                                            <div class="thumb">--}}
{{--                                                <a href="product-details.html"><img src="{{ asset('img/product/sm-img/2.jpg') }}" alt="product images"></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="content">--}}
{{--                                                <h6><a href="product-details.html">Compete Track Tote</a></h6>--}}
{{--                                                <span class="prize">$40.00</span>--}}
{{--                                                <div class="product_prize d-flex justify-content-between">--}}
{{--                                                    <span class="qun">Qty: 03</span>--}}
{{--                                                    <ul class="d-flex justify-content-end">--}}
{{--                                                        <li><a href="#"><i class="zmdi zmdi-settings"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="zmdi zmdi-delete"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="mini_action cart">--}}
{{--                                    <a class="cart__btn" href="cart.html">View and edit cart</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- End Shopping Cart -->
                    </li>
                    <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                        <div class="searchbar__content setting__block">
                            <div class="content-inner">
                                <div class="switcher-currency">
                                    @guest()
                                        <a class="label switcher-label">
                                            <span>Sign In</span>
                                        </a>
                                        <a class="label switcher-label">
                                            <span>Register</span>
                                        </a>

                                        {{--                                        <div class="switcher-options">--}}
{{--                                            <div class="switcher-currency-trigger">--}}
{{--                                                <span class="currency-trigger">Sign In</span>--}}
{{--                                                <span class="currency-trigger">Register</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    @else
                                        <strong class="label switcher-label">
                                            <span>Name</span>
                                        </strong>
                                        <div class="switcher-options">
                                            <div class="switcher-currency-trigger">
                                                <span class="currency-trigger">Your Cart</span>
                                                <span class="currency-trigger">Profile</span>
                                                <span class="currency-trigger">Log out</span>
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
                        <li><a href="index.html">Home</a></li>
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
    <form id="search_mini_form" class="minisearch" action="#">
        <div class="field__search">
            <input type="text" placeholder="Search entire store here...">
            <div class="action">
                <a href="#"><i class="zmdi zmdi-search"></i></a>
            </div>
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
                            <a class="shopbtn" href="#">shop now</a>
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
                            <a class="shopbtn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->
</div>
<!-- End Slider area -->
