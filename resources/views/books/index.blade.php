@extends('exam1.default')

@section('title', 'Book list')

@section('content')

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
                                                            <form action="{{ route('checkout.quick',$book->id) }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="books[0][id]" value="{{ $book->id }}">
                                                                <input type="hidden" name="books[0][quantity]" value="1">

                                                                <a class="cart" href="#" onclick="checkout_submit(this)"><i class="bi bi-shopping-bag4"></i></a>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a class="wishlist" href="{{ route('carts.show', $book->id) }}"><i class="bi bi-shopping-cart-full"></i></a>
                                                        </li>
                                                        <li>
                                                            <a class="compare" href="{{ route('favorites.show', $book->id) }}"><i class="bi bi-heart-beat"></i></a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                @php
                                                    $sum=0;

                                                    if(count($book->reviews) == 0)
                                                        $avg=0;
                                                    else{
                                                        foreach($book->reviews as $review){
                                                        $sum+=$review->star;
                                                        }
                                                        $avg=ceil($sum/count($book->reviews));
                                                    }
                                                @endphp
                                                <ul class="rating d-flex">
                                                    @for($star=0;$star<$avg;$star++)
                                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                                    @endfor
                                                    @for($star=5;$star>$avg;$star--)
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    @endfor
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
                                            <h2><a href="{{ route('books.show',$book->id) }}">{{ $book->name }}</a></h2>

                                            @php
                                                $sum=0;

                                                if(count($book->reviews) == 0)
                                                    $avg=0;
                                                else{
                                                    foreach($book->reviews as $review){
                                                    $sum+=$review->star;
                                                    }
                                                    $avg=ceil($sum/count($book->reviews));
                                                }
                                            @endphp
                                            <ul class="rating d-flex">
                                                @for($star=0;$star<$avg;$star++)
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                @endfor
                                                @for($star=5;$star>$avg;$star--)
                                                    <li><i class="fa fa-star-o"></i></li>
                                                @endfor
                                            </ul>
                                            <ul class="prize__box">
                                                <li>${{ $book->price }}</li>
                                                {{--                                                <li class="old__prize">{{ $book->price }}$</li>--}}
                                            </ul>
                                            <p> DESCRIBE: {!! substr($book->desc,0,250) . ' ...' !!}</p>
                                            <ul class="cart__action d-flex">
                                                <li class="cart">
                                                    <a href="{{ route('carts.show', $book->id) }}">Add to cart</a></li>
                                                <li class="wishlist">
                                                    <a href="{{ route('favorites.show', $book->id) }}"></a></li>
                                                <li class="compare">
                                                    <form action="{{ route('checkout.quick', $book->id) }}" method="post" style="display: inline-block">
                                                        @csrf
                                                        <input type="hidden" name="books[0][id]" value="{{ $book->id }}">
                                                        <input type="hidden" id="qty-quickCheck" name="books[0][quantity]" value="1">
                                                        <a class="compare" href="#" onclick="this.parentElement.submit()"></a>
                                                    </form>
                                                </li>

                                            </ul>

                                        </div>
                                    </div>
                                    <!-- End Single Product -->
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkout_submit(element) {
            element.parentElement.submit();
        }
    </script>
@endsection
