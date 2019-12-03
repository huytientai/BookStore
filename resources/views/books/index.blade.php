@extends('exam1.default')

@section('title', 'Book list')

@section('content')
    @include('flash::message')

    {{--    <h1>Books</h1>--}}
    {{--    @if(count($books)>0)--}}
    {{--        @foreach($books as $key => $book)--}}
    {{--            <div class="card card-body bg-light">--}}
    {{--                <div style="display:grid ;grid-template-columns: 30% 70%;grid-gap: 10px;">--}}
    {{--                    <div style="width: 200px; height: 200px; ">--}}
    {{--                        <a href="/books/{{$book->id}}">--}}
    {{--                            @if($book->image)--}}
    {{--                                <img src="/storage/book_images/{{ $book->image }}" style="width: 100%; height: 100%">--}}
    {{--                            @else--}}
    {{--                                <img style="width: 100%" src="/img/no_image.jpg') }}">--}}
    {{--                            @endif--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                    <div class="" style="width: 90%; height: 200px">--}}
    {{--                        <h3>{{ $books->firstItem() + $key }} . <a href="/books/{{$book->id}}"> {{ $book->name }}</a>--}}
    {{--                        </h3>--}}
    {{--                        <p> DESCRIBE: {!! substr($book->desc,0,180) . ' ...' !!}</p>--}}
    {{--                        <small>update on {{ $book->created_at }}</small>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <br>--}}
    {{--        @endforeach--}}
    {{--    @endif--}}
    {{--    <div style="width: 500px; height: 200px;">--}}
    {{--        {!! $books->links() !!}--}}
    {{--    </div>--}}


    <!-- End Bradcaump area -->
    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="wedget__categories poroduct--cat">
                            <h3 class="wedget__title">Book Categories</h3>
                            <ul>
                                <li><a href="{{ route('books.index') }}">All<span>(@php
                                                $x=0;
                                                foreach ($loaisachs as $loaisach){
                                                $x+=$loaisach->books_count;
                                                }
                                            echo $x;
                                            @endphp)</span></a></li>
                                @foreach($loaisachs as $loaisach)
                                    <li>
                                        <a href="{{ route('loaisachs.show', $loaisach->id) }}">{{ $loaisach->name }}
                                            <span>({{ count($loaisach->books) }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="wedget__categories pro--range">
                            <h3 class="wedget__title">Filter by price</h3>
                            <div class="content-shopby">
                                <div class="price_filter s-filter clear">
                                    <form action="#" method="GET">
                                        <div id="slider-range"></div>
                                        <div class="slider__range--output">
                                            <div class="price__output--wrap">
                                                <div class="price--output">
                                                    <span>Price :</span><input type="text" id="amount" readonly="">
                                                </div>
                                                <div class="price--filter">
                                                    <a href="#">Filter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </aside>

                        <aside class="wedget__categories sidebar--banner">
                            <img src="{{ asset('img/others/banner_left.jpg') }}" alt="banner images">
                            <div class="text">
                                <h2>new products</h2>
                                <h6>save up to <br> <strong>40%</strong>off</h6>
                            </div>
                        </aside>
                    </div>
                </div>
                {{--                end left page--}}

                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                                <div class="shop__list nav justify-content-center" role="tablist">
                                    <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                                    <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
                                </div>
                                <p>Total @php
                                        $x=0;
                                        foreach ($loaisachs as $loaisach){
                                        $x+=$loaisach->books_count;
                                        }
                                    echo $x;
                                    @endphp books</p>
                                <div class="orderby__wrapper"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab__container">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                            <div class="row">
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/1.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/2.jpg') }}" alt="product image"></a>
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
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/3.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/4.jpg') }}" alt="product image"></a>
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
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/7.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/8.jpg') }}" alt="product image"></a>
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
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/9.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/10.jpg') }}" alt="product image"></a>
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
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/11.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/2.jpg') }}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALER</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="single-product.html">Animals Life</a></h4>
                                        <ul class="prize d-flex">
                                            <li>$50.00</li>
                                            <li class="old_prize">$35.00</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/1.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/6.jpg') }}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALER</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="single-product.html">Olio Madu</a></h4>
                                        <ul class="prize d-flex">
                                            <li>$50.00</li>
                                            <li class="old_prize">$35.00</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/3.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/8.jpg') }}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALER</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="single-product.html">Soad Humber</a></h4>
                                        <ul class="prize d-flex">
                                            <li>$50.00</li>
                                            <li class="old_prize">$35.00</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/10.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/2.jpg') }}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALER</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="single-product.html">Animals Life</a></h4>
                                        <ul class="prize d-flex">
                                            <li>$50.00</li>
                                            <li class="old_prize">$35.00</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/7.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/3.jpg') }}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALER</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="single-product.html">Olio Madu</a></h4>
                                        <ul class="prize d-flex">
                                            <li>$50.00</li>
                                            <li class="old_prize">$35.00</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/1.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/5.jpg') }}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALER</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="single-product.html">War Of Dragon</a></h4>
                                        <ul class="prize d-flex">
                                            <li>$50.00</li>
                                            <li class="old_prize">$35.00</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/9.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/4.jpg') }}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALER</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="single-product.html">New World</a></h4>
                                        <ul class="prize d-flex">
                                            <li>$50.00</li>
                                            <li class="old_prize">$35.00</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/books/5.jpg') }}" alt="product image"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/8.jpg') }}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALER</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="single-product.html">Our World</a></h4>
                                        <ul class="prize d-flex">
                                            <li>$50.00</li>
                                            <li class="old_prize">$35.00</li>
                                        </ul>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li>
                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>
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
                                <!-- End Single Product -->
                            </div>
                            <ul class="wn__pagination">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                            </ul>
                        </div>
                        <div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
                            <div class="list__view__wrapper">
                                <!-- Start Single Product -->
                                <div class="list__view">
                                    <div class="thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/product/1.jpg') }}" alt="product images"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/product/2.jpg') }}" alt="product images"></a>
                                    </div>
                                    <div class="content">
                                        <h2><a href="single-product.html">Ali Smith</a></h2>
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <ul class="prize__box">
                                            <li>$111.00</li>
                                            <li class="old__prize">$220.00</li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                        <ul class="cart__action d-flex">
                                            <li class="cart"><a href="cart.html">Add to cart</a></li>
                                            <li class="wishlist"><a href="cart.html"></a></li>
                                            <li class="compare"><a href="cart.html"></a></li>
                                        </ul>

                                    </div>
                                </div>
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="list__view mt--40">
                                    <div class="thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/product/2.jpg') }}" alt="product images"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/product/4.jpg') }}" alt="product images"></a>
                                    </div>
                                    <div class="content">
                                        <h2><a href="single-product.html">Blood In Water</a></h2>
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <ul class="prize__box">
                                            <li>$111.00</li>
                                            <li class="old__prize">$220.00</li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                        <ul class="cart__action d-flex">
                                            <li class="cart"><a href="cart.html">Add to cart</a></li>
                                            <li class="wishlist"><a href="cart.html"></a></li>
                                            <li class="compare"><a href="cart.html"></a></li>
                                        </ul>

                                    </div>
                                </div>
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="list__view mt--40">
                                    <div class="thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/product/3.jpg') }}" alt="product images"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/product/6.jpg') }}" alt="product images"></a>
                                    </div>
                                    <div class="content">
                                        <h2><a href="single-product.html">Madeness Overated</a></h2>
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <ul class="prize__box">
                                            <li>$111.00</li>
                                            <li class="old__prize">$220.00</li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                        <ul class="cart__action d-flex">
                                            <li class="cart"><a href="cart.html">Add to cart</a></li>
                                            <li class="wishlist"><a href="cart.html"></a></li>
                                            <li class="compare"><a href="cart.html"></a></li>
                                        </ul>

                                    </div>
                                </div>
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="list__view mt--40">
                                    <div class="thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/product/4.jpg') }}" alt="product images"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/product/6.jpg') }}" alt="product images"></a>
                                    </div>
                                    <div class="content">
                                        <h2><a href="single-product.html">Watching You</a></h2>
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <ul class="prize__box">
                                            <li>$111.00</li>
                                            <li class="old__prize">$220.00</li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                        <ul class="cart__action d-flex">
                                            <li class="cart"><a href="cart.html">Add to cart</a></li>
                                            <li class="wishlist"><a href="cart.html"></a></li>
                                            <li class="compare"><a href="cart.html"></a></li>
                                        </ul>

                                    </div>
                                </div>
                                <!-- End Single Product -->
                                <!-- Start Single Product -->
                                <div class="list__view mt--40">
                                    <div class="thumb">
                                        <a class="first__img" href="single-product.html"><img src="{{ asset('img/product/5.jpg') }}" alt="product images"></a>
                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/product/9.jpg') }}" alt="product images"></a>
                                    </div>
                                    <div class="content">
                                        <h2><a href="single-product.html">Court Wings Run</a></h2>
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <ul class="prize__box">
                                            <li>$111.00</li>
                                            <li class="old__prize">$220.00</li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                        <ul class="cart__action d-flex">
                                            <li class="cart"><a href="cart.html">Add to cart</a></li>
                                            <li class="wishlist"><a href="cart.html"></a></li>
                                            <li class="compare"><a href="cart.html"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
