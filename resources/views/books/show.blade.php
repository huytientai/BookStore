@extends('exam1.default')

@section('title', $book->name . ' book')

@section('content')
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
                                    @canany(['admin','staff','warehouseman'])
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#import-modal">Import</button>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="product__info__main">
                                    <h1>{{ $book->name }}</h1>
                                    <div class="product-reviews-summary d-flex">
                                        @php
                                            $sum=0;
                                            foreach($book->reviews as $review){
                                                $sum+=$review->star;
                                            }
                                            if(count($book->reviews) == 0)
                                                $avg=0;
                                            else
                                                $avg=ceil($sum/count($book->reviews));
                                        @endphp

                                        <ul class="rating-summary d-flex">
                                            @for($i=0;$i<$avg;$i++)
                                                <li class="on"><i class="zmdi zmdi-star-outline"></i></li>
                                            @endfor
                                            @for($i=5;$i>$avg;$i--)
                                                <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                            @endfor
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span>${{ $book->price }}</span>
                                    </div>
                                    <div class="product__overview">
                                        <p>DESCRIBE: {!! substr($book->desc,0,250) . ' ...' !!}</p>
                                    </div>

                                    <h5>Nums: {{ $book->soluong }}</h5>
                                    <br>
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
											<span class="posted_in">Author:
												<a href="{{ route('tacgias.show', $book->tacgia_id) }}">{{ $book->tacgia->name }}</a>
											</span>
                                    </div>
                                    <div class="product_meta">
											<span class="posted_in">Publishing Company:
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
                                    <p>Publish Date: {{ $book->ngayxb }}</p>
                                    <p>Size: {{ $book->size }}</p>
                                    <p>Paper Cover: {{ $book->loaibia }}</p>
                                    <p>Pages: {{ $book->sotrang }}</p>
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
                                    @if(isset($book->reviews[0]))
                                        @foreach($book->reviews as $review)
                                            <div class="row">
                                                <h2>{{ $review->summary }}&nbsp;</h2>
                                                <div class="review__ratings__type d-flex ">
                                                    <div class="review-ratings">
                                                        <div class="rating-summary d-flex">
                                                            <ul class="rating d-flex">
                                                                @for($i=0; $i<$review->star; $i++)
                                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                                @endfor
                                                                @for($i=5; $i>$review->star; $i--)
                                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review__ratings__type d-flex">
                                                <div>
                                                    <p>Review by {{ $review->name }} ({{ $review->created_at }})</p>
                                                    <p>{{ $review->review }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="review-fieldset">
                                    <h2>You're reviewing:</h2>
                                    <h3>{{ $book->name }}</h3>
                                    <div class="review-field-ratings">
                                        <div class="product-review-table">
                                            <div class="review-field-rating d-flex">
                                                <span>Quality</span>
                                                <ul class="rating d-flex" id="your-rate">
                                                    <li class="off" onclick="vote(this)" data-value="1">
                                                        <i class="zmdi zmdi-star"></i></li>
                                                    <li class="off" onclick="vote(this)" data-value="2">
                                                        <i class="zmdi zmdi-star"></i></li>
                                                    <li class="off" onclick="vote(this)" data-value="3">
                                                        <i class="zmdi zmdi-star"></i></li>
                                                    <li class="off" onclick="vote(this)" data-value="4">
                                                        <i class="zmdi zmdi-star"></i></li>
                                                    <li class="off" onclick="vote(this)" data-value="5">
                                                        <i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review_form_field">
                                        <form action="{{ route('reviews.store') }}" method="post">
                                            @csrf
                                            @error('star')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <input type="hidden" value="6" id="star-review" name="star">
                                            <input type="hidden" value="{{ $book->id }}" name="book_id">
                                            <div class="input__box">
                                                <span>Nickname</span>
                                                <input id="nickname_field" type="text" name="name" required>
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="input__box">
                                                <span>Summary</span>
                                                <input id="summery_field" type="text" name="summary" required>
                                                @error('summary')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="input__box">
                                                <span>Review</span>
                                                <textarea name="review" required></textarea>
                                                @error('review')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Submit Review</button>
                                            </div>
                                        </form>
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

    {{--    import modal--}}
    <div id="import-modal" class="modal" role="dialog">
        <div class="modal-dialog">
            <form action="{{ route('books.importRequest',$book->id) }}" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title text-center text-dark">Import Book</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body" style="padding-left: 15px">
                        @csrf
                        <div>
                            <p>Quantity: </p>
                            <input type="number" class="form-control-sm" name="quantity" min="1" required>
                        </div>
                        <div>
                            <p>From: </p>
                            <input type="text" class="form-control-sm" name="from" >
                        </div>
                        <div>
                            <p>Note: </p>
                            <textarea type="text" class="form-control" name="note"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="" class="btn btn-primary">Send Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        var quantityInput = document.getElementById('qty');
        quantityInput.addEventListener('change', function (e) {
            var value = e.target
            if (isNaN(value.value) || value.value <= 0)
                value.value = 1
        })

        document.getElementsByClassName('review_form_field').item(0).getElementsByTagName('button').item(0).addEventListener('click', function (event) {
            var x = document.getElementById('star-review');
            if (x.value == 0) {
                alert('you have not vote yet');
                event.preventDefault()
            }
        })

        function vote(star) {
            var stars = star.parentElement
            val = star.getAttribute('data-value')
            for (var i = 0; i <= 4; i++) {
                var item = stars.getElementsByTagName('li').item(i);
                if (i < val) {
                    if (item.classList.contains('off')) {
                        item.classList.remove('off')
                        item.classList.add('on')
                        //font-size
                    }
                } else {
                    if (item.classList.contains('on')) {
                        item.classList.remove('on')
                        item.classList.add('off')
                    }
                }
            }
            var review = document.getElementById('star-review');
            review.value = val;
        }

    </script>

@endsection
