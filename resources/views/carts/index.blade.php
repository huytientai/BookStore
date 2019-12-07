@extends('exam1.default')

@section('title', 'Your Cart')

@section('content')

    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <form action="#">
                        <div class="table-content wnro__table table-responsive">
                            <table>
                                <thead>
                                <tr class="title-top">
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $cart)
                                    <tr class="each-cart">
                                        <td class="product-thumbnail">
                                            @if(isset($cart->book->image))
                                                <a href="{{ route('books.show', $cart->book_id) }}"><img src="/storage/book_images/{{ $cart->book->image }}"></a>
                                            @else
                                                <a href="{{ route('books.show', $cart->book_id) }}"><img src="/img/product/sm-3/1.jpg"></a>
                                            @endif
                                        </td>
                                        <td class="product-name"><a href="#">{{ $cart->book->name }}</a></td>
                                        <td class="product-price"><span class="amount">${{ $cart->book->price }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <input type="number" class="book-quantity" min="1" value="{{ $cart->quantity }}">
                                        </td>
                                        <td class="product-subtotal">${{ $cart->book->price * $cart->quantity }}</td>
                                        <td class="product-remove">
                                            <button type="button" class="btn btn-danger">X</button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="cartbox__btn">
                        <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                            {{--                            <li><a href="#">Coupon Code</a></li>--}}
                            {{--                            <li><a href="#">Apply Code</a></li>--}}
                            {{--                            <li><a href="#">Update Cart</a></li>--}}
                            {{--                            <li><a href="#">Check Out</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <div class="cartbox__total__area">
                        <div class="cartbox-total d-flex justify-content-between">
                            <ul class="cart__total__list">
                                <li>Cart total</li>
                            </ul>
                            <ul class="cart__total__tk">
                                <li>$70</li>
                            </ul>
                        </div>
                        <div class="cart__total__amount">
                            <span>Order</span>
                            {{--                            <span>$140</span>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        updateCartTotal()

        var removeCartItemButtons = document.getElementsByClassName('btn-danger');
        for (var i = 0; i < removeCartItemButtons.length; i++) {
            var button = removeCartItemButtons[i];
            button.addEventListener('click', function (event) {
                var buttonClicked = event.target
                buttonClicked.parentElement.parentElement.remove()
                updateCartTotal()
            })
        }

        function updateCartTotal() {
            var cartItemContainer = document.getElementsByClassName('each-cart')
            var total = 0

            for (var i = 0; i < cartItemContainer.length; i++) {
                var quantityElement = cartItemContainer[i].getElementsByClassName('book-quantity')[0];
                var priceElement = cartItemContainer[i].getElementsByClassName('amount')[0];

                var quantity = quantityElement.value
                var price = priceElement.innerText.replace('$', '')

                total += quantity * price
            }
            document.getElementsByClassName('cart__total__tk').item(0).getElementsByTagName('li').item(0).innerHTML ='$' + total
        }
    </script>
@endsection
