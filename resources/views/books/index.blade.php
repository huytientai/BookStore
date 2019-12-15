@extends('exam1.default')

@section('title', 'Book list')

@section('content')

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
            @include('flash::message')

            <div class="row">
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="wedget__categories poroduct--cat">
                            <h3 class="wedget__title">Categories</h3>
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
                            @canany(['admin','staff'])
                                <a class="btn btn-primary" href="{{ route('books.create') }}">Create Book</a>
                                <br><br>
                            @endcanany

                            <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                                <div class="shop__list nav justify-content-center" role="tablist">
                                    <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                                    <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
                                </div>
                                <p>Total {{ $books->total() }} books</p>
                                <div class="orderby__wrapper"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab__container">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                            <div class="row">
                            @foreach($books as $key => $book)
                                <!-- Start Single Product -->
                                    <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="product__thumb">
                                            @if(isset($book->image))
                                                <a class="first__img" href="{{ route('books.show', $book->id) }}"><img src="/storage/book_images/{{ $book->image }}"></a>
                                                {{--                                        <a class="second__img animation1" href="single-product.html"><img src="{{ asset('img/books/2.jpg') }}" alt="product image"></a>--}}
                                            @else
                                                <a class="first__img" href="{{ route('books.show', $book->id) }}"><img src="{{ asset('img/default_book.jpg') }}"></a>
                                            @endif
                                            <div class="hot__box">
                                            </div>
                                        </div>
                                        <div class="product__content content--center">
                                            <h4><a href="{{ route('books.show', $book->id) }}">{{ $book->name }}</a>
                                            </h4>
                                            <ul class="prize d-flex">
                                                <li>{{ $book->price }}$</li>
                                                {{--                                                <li class="old_prize">$35.00</li>--}}
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li>
                                                            <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $book->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
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
                            @endforeach
                            <!-- Start Single Product -->

                                <!-- End Single Product -->
                            </div>
                            {!! $books->appends(request()->input())->links() !!}
                        </div>


                        <div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
                            <div class="list__view__wrapper">
                                <!-- Start Single Product -->
                                @foreach($books as $book)
                                    <div class="list__view">
                                        <div class="thumb">
                                            @if(isset($book->image))
                                                <a class="first__img" href="{{ route('books.show', $book->id) }}"><img src="/storage/book_images/{{ $book->image }}" alt="product images"></a>
                                            @else
                                                <a class="first__img" href="{{ route('books.show', $book->id) }}"><img src="/img/books/default_book.jpg" alt="product images"></a>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <h2><a href="single-product.html">{{ $book->name }}</a></h2>
                                            <ul class="rating d-flex">
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="prize__box">
                                                <li>${{ $book->price }}</li>
{{--                                                <li class="old__prize">{{ $book->price }}$</li>--}}
                                            </ul>
                                            <p> DESCRIBE: {!! substr($book->desc,0,250) . ' ...' !!}</p>
                                            <ul class="cart__action d-flex">
                                                <li class="cart"><a href="{{ route('carts.show', $book->id) }}">Add to cart</a></li>
                                                <li class="wishlist"><a href="cart.html"></a></li>
                                                <li class="compare"><a href="cart.html"></a></li>
                                            </ul>

                                        </div>
                                    </div>
                                    <!-- End Single Product -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
