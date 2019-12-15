@extends('exam1.default')

@section('title', $book->name . ' book')

@section('content')

    {{--    <div class="col-md-8 col-sm-8">--}}
    {{--        <br>--}}
    {{--        @if($book->image)--}}
    {{--            <img style="width: 100%" src="/storage/book_images/{{ $book->image }}">--}}
    {{--        @else--}}
    {{--            <img style="width: 70%" src="/img/no_image.jpg">--}}
    {{--        @endif--}}
    {{--    </div>--}}
    {{--    <br>--}}
    {{--    <h1>{{ $book->name }}</h1>--}}
    {{--    <br>--}}
    {{--    <h4> Describe</h4>--}}
    {{--    <p>{!! $book->desc !!}</p>--}}

    {{--    <hr>--}}
    {{--    <small>written on {{ $book->created_at }}</small>--}}
    {{--    <hr>--}}

    {{--    @canany(['admin','staff'])--}}
    {{--        <a class="btn btn-primary" href="{{ route('books.edit', $book->id) }}">Edit</a>--}}
    {{--        <form action="{{ route('books.destroy', $book->id) }}" method="post">--}}
    {{--            @csrf--}}
    {{--            @method('DELETE')--}}

    {{--            <button type="submit" class="btn btn-danger">Delete</button>--}}
    {{--        </form>--}}
    {{--    @endcanany--}}

    <!-- Start main Content -->
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            @include('flash::message')

            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="wn__single__product">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="wn__fotorama__wrapper">
                                    <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                                        @if($book->image)
                                            <a><img style="width: 100%" src="/storage/book_images/{{ $book->image }}"></a>
                                        @else
                                            <a><img style="width: 100%" src="/img/books/default_book.jpg"></a>
                                        @endif
                                    </div>
                                    <br><br>
                                    <div class="row" style="padding-left: 15px">
                                        @canany(['admin','staff'])
                                            <a class="btn btn-primary" href="{{ route('books.edit', $book->id) }}">Edit</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcanany
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="product__info__main">
                                    <h1>{{ $book->name }}</h1>
                                    <div class="product-reviews-summary d-flex">
                                        <ul class="rating-summary d-flex">
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span>${{ $book->price }}</span>
                                    </div>
                                    <div class="product__overview">
                                        <p>DESCRIBE: {!! substr($book->desc,0,250) . ' ...' !!}</p>
                                    </div>
                                    <div class="box-tocart d-flex row">
                                        <form action="{{ route('carts.store') }}" class="row" method="post">
                                            <span>Qty</span>
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <input id="qty" class="input-text qty" name="quantity" min="1" value="1" title="Qty" type="number">
                                            <div class="addtocart__actions">
                                                <button class="tocart" type="submit" title="Add to Cart">Add to Cart</button>
                                            </div>
                                        </form>
                                        {{--                                        <div class="product-addto-links clearfix">--}}
                                        {{--                                            <a class="wishlist" href="#"></a>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <div class="product_meta">
											<span class="posted_in">Categories:
												<a href="{{ route('loaisachs.show', $book->loaisach->id) }}">{{ $book->loaisach->name }}</a>
											</span>
                                    </div>
                                    <div class="product_meta">
											<span class="posted_in">Tac Gia:
												<a href="{{ route('tacgias.show', $book->tacgia_id) }}">{{ $book->tacgia->name }}</a>
											</span>
                                    </div>
                                    <div class="product_meta">
											<span class="posted_in">Nha Xuat Ban:
												<a href="{{ route('nhaxuatbans.show', $book->nhaxuatban_id) }}">{{ $book->nhaxuatban->name }}</a>
											</span>
                                    </div>

                                    <div class="product-share">
                                        <ul>
                                            <li class="categories-title">Share :</li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-twitter icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-tumblr icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-facebook icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-linkedin icons"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product__info__detailed">
                        <div class="pro_details_nav nav justify-content-start" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Details</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Reviews</a>
                        </div>
                        <div class="tab__container">
                            <!-- Start Single Tab Content -->
                            <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                                <div class="description__attribute">
                                    <p>{!! $book->desc !!}</p>
                                    <br>
                                    <p>Ngay Xuat Ban: {{ $book->ngayxb }}</p>
                                    <p>Size: {{ $book->size }}</p>
                                    <p>Loai Bia: {{ $book->loaibia }}</p>
                                    <p>So Trang: {{ $book->sotrang }}</p>
                                    <ul>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Tab Content -->
                            <!-- Start Single Tab Content -->
                            <div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
                                <div class="review__attribute">
                                    <h1>Customer Reviews</h1>
                                    <h2>Hastech</h2>
                                    <div class="review__ratings__type d-flex">
                                        <div class="review-ratings">
                                            <div class="rating-summary d-flex">
                                                <span>Quality</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>

                                            <div class="rating-summary d-flex">
                                                <span>Price</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="rating-summary d-flex">
                                                <span>value</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <p>Hastech</p>
                                            <p>Review by Hastech</p>
                                            <p>Posted on 11/6/2018</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-fieldset">
                                    <h2>You're reviewing:</h2>
                                    <h3>Chaz Kangeroo Hoodie</h3>
                                    <div class="review-field-ratings">
                                        <div class="product-review-table">
                                            <div class="review-field-rating d-flex">
                                                <span>Quality</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="review-field-rating d-flex">
                                                <span>Price</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="review-field-rating d-flex">
                                                <span>Value</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review_form_field">
                                        <div class="input__box">
                                            <span>Nickname</span>
                                            <input id="nickname_field" type="text" name="nickname">
                                        </div>
                                        <div class="input__box">
                                            <span>Summary</span>
                                            <input id="summery_field" type="text" name="summery">
                                        </div>
                                        <div class="input__box">
                                            <span>Review</span>
                                            <textarea name="review"></textarea>
                                        </div>
                                        <div class="review-form-actions">
                                            <button>Submit Review</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Tab Content -->
                        </div>
                    </div>
                    {{--                    <div class="wn__related__product pt--80 pb--50">--}}
                    {{--                        <div class="section__title text-center">--}}
                    {{--                            <h2 class="title__be--2">Related Products</h2>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="row mt--60">--}}
                    {{--                            <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/1.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/2.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">BEST SALLER</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center">--}}
                    {{--                                        <h4><a href="single-product.html">robin parrish</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$35.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/3.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/4.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box color--2">--}}
                    {{--                                            <span class="hot-label">HOT</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center">--}}
                    {{--                                        <h4><a href="single-product.html">The Remainng</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$35.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/7.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/8.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">HOT</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center">--}}
                    {{--                                        <h4><a href="single-product.html">Lando</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$35.00</li>--}}
                    {{--                                            <li class="old_prize">$50.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/9.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/10.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">HOT</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center">--}}
                    {{--                                        <h4><a href="single-product.html">Doctor Wldo</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$35.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/11.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/2.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">BEST SALER</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center content--center">--}}
                    {{--                                        <h4><a href="single-product.html">Animals Life</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$50.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/1.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/6.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">BEST SALER</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center content--center">--}}
                    {{--                                        <h4><a href="single-product.html">Olio Madu</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$50.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="wn__related__product">--}}
                    {{--                        <div class="section__title text-center">--}}
                    {{--                            <h2 class="title__be--2">upsell products</h2>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="row mt--60">--}}
                    {{--                            <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/1.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/2.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">BEST SALLER</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center">--}}
                    {{--                                        <h4><a href="single-product.html">robin parrish</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$35.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/3.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/4.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box color--2">--}}
                    {{--                                            <span class="hot-label">HOT</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center">--}}
                    {{--                                        <h4><a href="single-product.html">The Remainng</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$35.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/7.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/8.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">HOT</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center">--}}
                    {{--                                        <h4><a href="single-product.html">Lando</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$35.00</li>--}}
                    {{--                                            <li class="old_prize">$50.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/9.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/10.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">HOT</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center">--}}
                    {{--                                        <h4><a href="single-product.html">Doctor Wldo</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$35.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/11.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/2.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">BEST SALER</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center content--center">--}}
                    {{--                                        <h4><a href="single-product.html">Animals Life</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$50.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--                                    <div class="product__thumb">--}}
                    {{--                                        <a class="first__img" href="single-product.html"><img src="/img/books/1.jpg" alt="product image"></a>--}}
                    {{--                                        <a class="second__img animation1" href="single-product.html"><img src="/img/books/6.jpg" alt="product image"></a>--}}
                    {{--                                        <div class="hot__box">--}}
                    {{--                                            <span class="hot-label">BEST SALER</span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="product__content content--center content--center">--}}
                    {{--                                        <h4><a href="single-product.html">Olio Madu</a></h4>--}}
                    {{--                                        <ul class="prize d-flex">--}}
                    {{--                                            <li>$50.00</li>--}}
                    {{--                                            <li class="old_prize">$35.00</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                        <div class="action">--}}
                    {{--                                            <div class="actions_inner">--}}
                    {{--                                                <ul class="add_to_links">--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                    <li>--}}
                    {{--                                                        <a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>--}}
                    {{--                                                    </li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="product__hover--content">--}}
                    {{--                                            <ul class="rating d-flex">--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li class="on"><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                                <li><i class="fa fa-star-o"></i></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- Start Single Product -->--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="wedget__categories poroduct--cat">
                            <h3 class="wedget__title">Product Categories</h3>
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
                            <img src="/img/others/banner_left.jpg" alt="banner images">
                            <div class="text">
                                <h2>new products</h2>
                                <h6>save up to <br> <strong>40%</strong>off</h6>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
