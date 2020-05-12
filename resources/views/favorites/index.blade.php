@extends('exam1.default')

@section('title', 'Your Favorites')

@section('content')
    <div class="wishlist-area section-padding--lg bg__white">
        <div class="container">
            @include('flash::message')

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="wishlist-content">
                        <div class="wishlist-table wnro__table table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name"><span class="nobr">Product Name</span></th>
                                    <th class="product-price"><span class="nobr"> Unit Price </span></th>
                                    <th class="product-stock-stauts"><span class="nobr"> Star </span></th>
                                    <th class="product-add-to-cart"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($favorites))
                                    @foreach($favorites as $favorite)
                                        <tr>
                                            <td class="product-remove">
                                                <form action="{{ route('favorites.destroy', $favorite->book_id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn">x</button>
                                                </form>
                                            </td>
                                            <td class="product-thumbnail" style="width: 170px;">
                                                @if($favorite->book->image)
                                                    <a href="{{ route('books.show', $favorite->book_id) }}"><img style="width: 60%;" src="/storage/book_images/{{ $favorite->book->image }}" alt=""></a>
                                                @else
                                                    <a><img src="{{ asset('img/product/sm-3/1.jpg') }}" alt="alt_img"></a>
                                                @endif
                                            </td>
                                            <td class="product-name">
                                                <a href="{{ route('books.show',$favorite->book_id) }}">{{ $favorite->book->name }}</a>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">${{ $favorite->book->price }}</span></td>
                                            <td class="product-stock-status" style="padding-right: 0px;padding-left: 10px">
                                                    <span class="wishlist-in-stock">
                                                        @php
                                                            $sum=0;

                                                            if(count($favorite->book->reviews) == 0)
                                                                $avg=0;
                                                            else{
                                                                foreach($favorite->book->reviews as $review){
                                                                $sum+=$review->star;
                                                                }
                                                                $avg=ceil($sum/count($favorite->book->reviews));
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
                                                    </span>
                                            </td>
                                            <td class="product-add-to-cart">
                                                <a href="{{ route('carts.show',$favorite->book_id) }}"> Add to Cart</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
