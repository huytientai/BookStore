@extends('exam1.default')

@section('title', config('app.name','Home'))

@section('content')

    <section class="wn__product__area brown--color pt--80  pb--30">
        <div class="container">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title text-center">
                        <h2 class="title__be--2">New <span class="color--theme">Books</span></h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
                    </div>
                </div>
            </div>
            <!-- Start Single Tab Content -->
            <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
                <!-- Start Single Product -->
                <div class="product product__style--3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product__thumb">
                            <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/1.jpg') }}" alt="product image"></a>
                            {{--                            <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/2.jpg') }}" alt="product image"></a>--}}
                            <div class="hot__box">
                                <span class="hot-label">BEST SALLER</span>
                            </div>
                        </div>
                        <div class="product__content content--center">
                            <h4><a href="single-product.html">robin parrish</a></h4>
                            <ul class="prize d-flex">
                                <li>$35.00</li>
                                <li class="old_prize">$35.00</li>
                            </ul>
                            <div class="action">
                                <div class="actions_inner">
                                    <ul class="add_to_links">
                                        <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                        </li>
                                        <li>
                                            <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
                                        </li>
                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                        <li>
                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product__hover--content">
                                <ul class="rating d-flex">
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product__thumb">
                            <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/3.jpg') }}" alt="product image"></a>
                            {{--                            <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/4.jpg') }}" alt="product image"></a>--}}
                            <div class="hot__box color--2">
                                <span class="hot-label">HOT</span>
                            </div>
                        </div>
                        <div class="product__content content--center">
                            <h4><a href="single-product.html">The Remainng</a></h4>
                            <ul class="prize d-flex">
                                <li>$35.00</li>
                                <li class="old_prize">$35.00</li>
                            </ul>
                            <div class="action">
                                <div class="actions_inner">
                                    <ul class="add_to_links">
                                        <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                        </li>
                                        <li>
                                            <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
                                        </li>
                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                        <li>
                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product__hover--content">
                                <ul class="rating d-flex">
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product__thumb">
                            <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/5.jpg') }}" alt="product image"></a>
                            {{--                            <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/6.jpg') }}" alt="product image"></a>--}}
                            <div class="hot__box">
                                <span class="hot-label">BEST SALLER</span>
                            </div>
                        </div>
                        <div class="product__content content--center">
                            <h4><a href="single-product.html">Bowen Greenwood</a></h4>
                            <ul class="prize d-flex">
                                <li>$40.00</li>
                                <li class="old_prize">$35.00</li>
                            </ul>
                            <div class="action">
                                <div class="actions_inner">
                                    <ul class="add_to_links">
                                        <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                        </li>
                                        <li>
                                            <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
                                        </li>
                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                        <li>
                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product__hover--content">
                                <ul class="rating d-flex">
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product__thumb">
                            <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/7.jpg') }}" alt="product image') }}"></a>
                            {{--                            <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/8.jpg') }}" alt="product image"></a>--}}
                            <div class="hot__box">
                                <span class="hot-label">HOT</span>
                            </div>
                        </div>
                        <div class="product__content content--center">
                            <h4><a href="single-product.html">Lando</a></h4>
                            <ul class="prize d-flex">
                                <li>$35.00</li>
                                <li class="old_prize">$50.00</li>
                            </ul>
                            <div class="action">
                                <div class="actions_inner">
                                    <ul class="add_to_links">
                                        <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                        </li>
                                        <li>
                                            <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
                                        </li>
                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                        <li>
                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product__hover--content">
                                <ul class="rating d-flex">
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product__thumb">
                            <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/9.jpg') }}" alt="product image"></a>
                            {{--                            <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/10.jpg') }}" alt="product image"></a>--}}
                            <div class="hot__box">
                                <span class="hot-label">HOT</span>
                            </div>
                        </div>
                        <div class="product__content content--center">
                            <h4><a href="single-product.html">Doctor Wldo</a></h4>
                            <ul class="prize d-flex">
                                <li>$35.00</li>
                                <li class="old_prize">$35.00</li>
                            </ul>
                            <div class="action">
                                <div class="actions_inner">
                                    <ul class="add_to_links">
                                        <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                        </li>
                                        <li>
                                            <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
                                        </li>
                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                        <li>
                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product__hover--content">
                                <ul class="rating d-flex">
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product__thumb">
                            <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/11.jpg') }}" alt="product image"></a>
                            {{--                            <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/2.jpg') }}" alt="product image"></a>--}}
                            <div class="hot__box">
                                <span class="hot-label">BEST SALER</span>
                            </div>
                        </div>
                        <div class="product__content content--center content--center">
                            <h4><a href="single-product.html">Ghost</a></h4>
                            <ul class="prize d-flex">
                                <li>$50.00</li>
                                <li class="old_prize">$35.00</li>
                            </ul>
                            <div class="action">
                                <div class="actions_inner">
                                    <ul class="add_to_links">
                                        <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                        </li>
                                        <li>
                                            <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
                                        </li>
                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                        <li>
                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product__hover--content">
                                <ul class="rating d-flex">
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single Product -->
                </div>
            </div>
            <!-- End Single Tab Content -->
        </div>
    </section>
    <!-- Start BEst Seller Area -->
    <!-- Start NEwsletter Area -->
    <section class="wn__newsletter__area bg-image--2">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-5 col-md-12 col-12 ptb--150">
                    <div class="section__title text-center">
                        <h2>Stay With Us</h2>
                    </div>
                    <div class="newsletter__block text-center">
                        <p>Subscribe to our newsletters now and stay up-to-date with new collections, the latest lookbooks and exclusive offers.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End NEwsletter Area -->
    <!-- Start Best Seller Area -->
    <section class="wn__bestseller__area bg--white pt--80  pb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title text-center">
                        <h2 class="title__be--2">HOT <span class="color--theme">Books</span></h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
                    </div>
                </div>
            </div>
            <div class="row mt--50">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="product__nav nav justify-content-center" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-all" role="tab">ALL</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-biographic" role="tab">{{ $b1[0]->loaisach->name }}</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-adventure" role="tab">ADVENTURE</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-children" role="tab">CHILDREN</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-cook" role="tab">COOK</a>
                    </div>
                </div>
            </div>

            <div class="tab__container mt--60">
                <!-- Start Single Tab Content -->
                <div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
                    <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                        @for($i=0; $i<count($b0); $i=$i + 2)
                            <div class="single__product">
                                <!-- Start Single Product -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b0[$i]->id) }}">
                                                @if(isset($b0[$i]->image))
                                                    <img src="/storage/book_images/{{ $b0[$i]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4><a href="{{ route('books.show', $b0[$i]->id) }}">{{ $b0[$i]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b0[$i]->price }}</li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b0[$i]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b0[$i+1]->id) }}">
                                                @if(isset($b0[$i+1]->image))
                                                    <img src="/storage/book_images/{{ $b0[$i+1]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4>
                                                <a href="{{ route('books.show', $b0[$i+1]->id) }}">{{ $b0[$i+1]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b0[$i+1]->price }}</li>
                                                {{--                                                <li class="old_prize">$35.00</li>--}}
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b0[$i+1]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <!-- End Single Tab Content -->
                <!-- Start Single Tab Content 2-->
                <div class="row single__tab tab-pane fade" id="nav-biographic" role="tabpanel">
                    <div class="product__indicator--4 arrows_style owl-carousel owl-theme">

                    @for($i=0; $i<count($b0); $i=$i + 2)
                        <!-- Start Single Product -->
                            <div class="single__product">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b1[$i]->id) }}">
                                                @if(isset($b1[$i]->image))
                                                    <img src="/storage/book_images/{{ $b1[$i]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALLER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center">
                                            <h4><a href="{{ route('books.show', $b1[$i]->id) }}">{{ $b1[$i]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b1[$i]->price }}</li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b1[$i]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start Single Product -->
                                <!-- Start Single Product -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b1[$i+1]->id) }}">
                                                @if(isset($b1[$i+1]->image))
                                                    <img src="/storage/book_images/{{ $b1[$i+1]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALLER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center">
                                            <h4>
                                                <a href="{{ route('books.show', $b1[$i+1]->id) }}">{{ $b1[$i+1]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b1[$i]->price }}</li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b1[$i+1]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <!-- End Single Tab Content -->
                <!-- Start Single Tab Content 3 -->
                <div class="row single__tab tab-pane fade" id="nav-adventure" role="tabpanel">
                    <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                        @for($i=0; $i<count($b2); $i=$i + 2)
                            <div class="single__product">
                                <!-- Start Single Product -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b2[$i]->id) }}">
                                                @if(isset($b2[$i]->image))
                                                    <img src="/storage/book_images/{{ $b2[$i]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4><a href="{{ route('books.show', $b2[$i]->id) }}">{{ $b2[$i]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b2[$i]->price }}</li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b2[$i]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b2[$i+1]->id) }}">
                                                @if(isset($b2[$i+1]->image))
                                                    <img src="/storage/book_images/{{ $b2[$i+1]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4>
                                                <a href="{{ route('books.show', $b2[$i+1]->id) }}">{{ $b2[$i+1]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b2[$i+1]->price }}</li>
                                                {{--                                                <li class="old_prize">$35.00</li>--}}
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b2[$i+1]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor

                    </div>
                </div>
                <!-- End Single Tab Content -->
                <!-- Start Single Tab Content -->
                <div class="row single__tab tab-pane fade" id="nav-children" role="tabpanel">
                    <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                        @for($i=0; $i<count($b3); $i=$i + 2)
                            <div class="single__product">
                                <!-- Start Single Product -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b3[$i]->id) }}">
                                                @if(isset($b3[$i]->image))
                                                    <img src="/storage/book_images/{{ $b3[$i]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4><a href="{{ route('books.show', $b3[$i]->id) }}">{{ $b3[$i]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b3[$i]->price }}</li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b3[$i]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b3[$i+1]->id) }}">
                                                @if(isset($b3[$i+1]->image))
                                                    <img src="/storage/book_images/{{ $b3[$i+1]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4>
                                                <a href="{{ route('books.show', $b3[$i+1]->id) }}">{{ $b3[$i+1]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b3[$i+1]->price }}</li>
                                                {{--                                                <li class="old_prize">$35.00</li>--}}
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b3[$i+1]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <!-- End Single Tab Content -->
                <!-- Start Single Tab Content -->
                <div class="row single__tab tab-pane fade" id="nav-cook" role="tabpanel">
                    <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                        @for($i=0; $i<count($b4); $i=$i + 2)
                            <div class="single__product">
                                <!-- Start Single Product -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b4[$i]->id) }}">
                                                @if(isset($b4[$i]->image))
                                                    <img src="/storage/book_images/{{ $b4[$i]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4><a href="{{ route('books.show', $b4[$i]->id) }}">{{ $b4[$i]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b4[$i]->price }}</li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b4[$i]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{ route('books.show', $b4[$i+1]->id) }}">
                                                @if(isset($b4[$i+1]->image))
                                                    <img src="/storage/book_images/{{ $b4[$i+1]->image }}">
                                                @else
                                                    <img src="/img/books/default_book.jpg">
                                                @endif
                                            </a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4>
                                                <a href="{{ route('books.show', $b4[$i+1]->id) }}">{{ $b4[$i+1]->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>${{ $b4[$i+1]->price }}</li>
                                                {{--                                                <li class="old_prize">$35.00</li>--}}
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $b4[$i+1]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <!-- End Single Tab Content -->
            </div>
        </div>
    </section>
    <!-- Start BEst Seller Area -->
    <!-- Start Recent Post Area -->
    <section class="wn__recent__post bg--gray ptb--80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title text-center">
                        <h2 class="title__be--2">Tac Gia</span></h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
                    </div>
                </div>
            </div>
            <div class="row mt--50">
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="post__itam">
                        <div class="content">
                            @if(isset($tacgias[0]->image))
                                <a href="{{ route('tacgias.show', $tacgias[0]->id) }}"><img src="/storage/tacgia_images/{{ $tacgias[0]->image }}"></a>
                            @else
                                <a href="{{ route('tacgias.show', $tacgias[0]->id) }}"><img src="/img/tacgias/default.jpg"></a>
                            @endif
                            <div class="post__time">
                                <span>{{ $tacgias[0]->name }}</span>

                                <div class="post-meta">
                                    <span class="day">{{ $tacgias[0]->born }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="post__itam">
                        <div class="content">
                            @if(isset($tacgias[1]->image))
                                <a href="{{ route('tacgias.show', $tacgias[1]->id) }}"><img src="/storage/tacgia_images/{{ $tacgias[1]->image }}"></a>
                            @else
                                <a href="{{ route('tacgias.show', $tacgias[1]->id) }}"><img src="/img/tacgias/default.jpg"></a>
                            @endif
                            <div class="post__time">
                                <span>{{ $tacgias[1]->name }}</span>

                                <div class="post-meta">
                                    <span class="day">{{ $tacgias[1]->born }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="post__itam">
                        <div class="content">
                            @if(isset($tacgias[2]->image))
                                <a href="{{ route('tacgias.show', $tacgias[2]->id) }}"><img src="/storage/tacgia_images/{{ $tacgias[2]->image }}"></a>
                            @else
                                <a href="{{ route('tacgias.show', $tacgias[2]->id) }}"><img src="/img/tacgias/default.jpg"></a>
                            @endif
                            <div class="post__time">
                                <span>{{ $tacgias[2]->name }}</span>

                                <div class="post-meta">
                                    <span class="day">{{ $tacgias[2]->born }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Recent Post Area -->
    <!-- Best Sale Area -->
    <section class="best-seel-area pt--80 pb--60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title text-center pb--50">
                        <h2 class="title__be--2">Best <span class="color--theme">Seller </span></h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider center">
            <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    {{--                    <a class="first__img" href="single-product.html"><img src="{{ asset('img/best-sell-product/1.jpg') }}" alt="product image"></a>--}}
                    @if(isset($best_books[0]->image))
                        <a class="first__img" href="{{ route('books.show', $best_books[0]->id) }}"><img src="/storage/book_images/{{ $best_books[0]->image }}" alt="product image"></a>
                    @else
                        <a class="first__img" href="{{ route('books.show', $best_books[0]->id) }}"><img src="{{ asset('img/books/default_book.jpg') }}" alt="product image"></a>
                    @endif

                </div>
                <div class="product__content content--center">
                    <div class="action">
                        <div class="actions_inner">
                            <ul class="add_to_links">
                                <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a></li>
                                <li>
                                    <a class="wishlist" href="{{ route('carts.show', $best_books[0]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                </li>
                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                <li>
                                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__hover--content">
                        <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single product end -->
            <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    {{--                    <a class="first__img" href="single-product.html"><img src="{{ asset('img/best-sell-product/2.jpg') }}" alt="product image"></a>--}}
                    @if(isset($best_books[1]->image))
                        <a class="first__img" href="{{ route('books.show', $best_books[1]->id) }}"><img src="/storage/book_images/{{ $best_books[1]->image }}" alt="product image"></a>
                    @else
                        <a class="first__img" href="{{ route('books.show', $best_books[1]->id) }}"><img src="{{ asset('img/books/default_book.jpg') }}" alt="product image"></a>
                    @endif
                </div>
                <div class="product__content content--center">
                    <div class="action">
                        <div class="actions_inner">
                            <ul class="add_to_links">
                                <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a></li>
                                <li>
                                    <a class="wishlist" href="{{ route('carts.show', $best_books[1]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                </li>
                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                <li>
                                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__hover--content">
                        <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single product end -->
            <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    {{--                    <a class="first__img" href="single-product.html"><img src="{{ asset('img/best-sell-product/3.jpg') }}" alt="product image"></a>--}}
                    @if(isset($best_books[2]->image))
                        <a class="first__img" href="{{ route('books.show', $best_books[2]->id) }}"><img src="/storage/book_images/{{ $best_books[2]->image }}" alt="product image"></a>
                    @else
                        <a class="first__img" href="{{ route('books.show', $best_books[2]->id) }}"><img src="{{ asset('img/books/default_book.jpg') }}" alt="product image"></a>
                    @endif
                </div>
                <div class="product__content content--center">
                    <div class="action">
                        <div class="actions_inner">
                            <ul class="add_to_links">
                                <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a></li>
                                <li>
                                    <a class="wishlist" href="{{ route('carts.show', $best_books[2]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                </li>
                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                <li>
                                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__hover--content">
                        <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single product end -->
            <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    {{--                    <a class="first__img" href="single-product.html"><img src="{{ asset('img/best-sell-product/4.jpg') }}" alt="product image"></a>--}}
                    @if(isset($best_books[3]->image))
                        <a class="first__img" href="{{ route('books.show', $best_books[3]->id) }}"><img src="/storage/book_images/{{ $best_books[3]->image }}" alt="product image"></a>
                    @else
                        <a class="first__img" href="{{ route('books.show', $best_books[3]->id) }}"><img src="{{ asset('img/books/default_book.jpg') }}" alt="product image"></a>
                    @endif
                </div>
                <div class="product__content content--center">
                    <div class="action">
                        <div class="actions_inner">
                            <ul class="add_to_links">
                                <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a></li>
                                <li>
                                    <a class="wishlist" href="{{ route('carts.show', $best_books[3]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                </li>
                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                <li>
                                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__hover--content">
                        <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single product end -->
            <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img src="{{ asset('img/best-sell-product/5.jpg') }}" alt="product image"></a>
                    {{--                    @if(isset($best_books[4]->image))--}}
                    {{--                        <a class="first__img" href="{{ route('books.show', $best_books[4]->id) }}"><img src="/storage/book_images/{{ $best_books[4]->image }}" alt="product image"></a>--}}
                    {{--                    @else--}}
                    {{--                        <a class="first__img" href="{{ route('books.show', $best_books[4]->id) }}"><img src="{{ asset('img/books/default_book.jpg') }}" alt="product image"></a>--}}
                    {{--                    @endif--}}
                </div>
                <div class="product__content content--center">
                    <div class="action">
                        <div class="actions_inner">
                            <ul class="add_to_links">
                                <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a></li>
                                <li>
                                    <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
                                </li>
                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                <li>
                                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__hover--content">
                        <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single product end -->
            <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    @if(isset($best_books[4]->image))
                        <a class="first__img" href="{{ route('books.show', $best_books[4]->id) }}"><img src="/storage/book_images/{{ $best_books[4]->image }}" alt="product image"></a>
                    @else
                        <a class="first__img" href="{{ route('books.show', $best_books[4]->id) }}"><img src="{{ asset('img/books/default_book.jpg') }}" alt="product image"></a>
                    @endif
                </div>
                <div class="product__content content--center">
                    <div class="action">
                        <div class="actions_inner">
                            <ul class="add_to_links">
                                <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a></li>
                                <li>
                                    <a class="wishlist" href="{{ route('carts.show', $best_books[4]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                </li>
                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                <li>
                                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__hover--content">
                        <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single product end -->
            <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    @if(isset($best_books[5]->image))
                        <a class="first__img" href="{{ route('books.show', $best_books[5]->id) }}"><img src="/storage/book_images/{{ $best_books[5]->image }}" alt="product image"></a>
                    @else
                        <a class="first__img" href="{{ route('books.show', $best_books[5]->id) }}"><img src="{{ asset('img/books/default_book.jpg') }}" alt="product image"></a>
                    @endif
                </div>
                <div class="product__content content--center">
                    <div class="action">
                        <div class="actions_inner">
                            <ul class="add_to_links">
                                <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a></li>
                                <li>
                                    <a class="wishlist" href="{{ route('carts.show', $best_books[5]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                </li>
                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                <li>
                                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__hover--content">
                        <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single product end -->
            <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    @if(isset($best_books[6]->image))
                        <a class="first__img" href="{{ route('books.show', $best_books[6]->id) }}"><img src="/storage/book_images/{{ $best_books[6]->image }}" alt="product image"></a>
                    @else
                        <a class="first__img" href="{{ route('books.show', $best_books[6]->id) }}"><img src="{{ asset('img/books/default_book.jpg') }}" alt="product image"></a>
                    @endif
                </div>
                <div class="product__content content--center">
                    <div class="action">
                        <div class="actions_inner">
                            <ul class="add_to_links">
                                <li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a></li>
                                <li>
                                    <a class="wishlist" href="{{ route('carts.show', $best_books[6]->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                </li>
                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                <li>
                                    <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__hover--content">
                        <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single product end -->
        </div>
    </section>
    <!-- Best Sale Area Area -->

    <!-- QUICKVIEW PRODUCT -->
    @include('exam1.quickview')
    <!-- END QUICKVIEW PRODUCT -->
@endsection
