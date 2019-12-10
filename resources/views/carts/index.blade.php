@extends('exam1.default')

@section('title', 'Your Cart')

@section('content')

    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            @include('flash::message')

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
                                        <td class="product-name">
                                            <a href="{{ route('books.show', $cart->book_id) }}">{{ $cart->book->name }}</a>
                                        </td>
                                        <td class="product-price"><span class="amount">${{ $cart->book->price }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <input type="number" class="book-quantity" min="1" value="{{ $cart->quantity }}">
                                            <input type="hidden" class="book-id" name="book-id" value="{{ $cart->id }}">
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
                                <li>$</li>
                            </ul>
                        </div>
                        <form action="{{ route('carts.update', 1) }}" id="order-form" method="post">
                            @csrf
                            @method('PUT')
                            <button type="button" class="btn cart__total__amount" style="width: 100%" onclick="order()">ORDER</button>
                        </form>
                    </div>
                </div>
            </div>


            {{--                current order--}}
            <br><br><br>
            <hr>
            <br>
            <h2>Current Order</h2>
            <br>
            @if(isset($order))
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                        <div class="table-content wnro__table table-responsive">
                            <table>
                                <thead>
                                <tr class="title-top">
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderdetails as $orderdetail)
                                    <tr>
                                        <td class="product-thumbnail">
                                            @if(isset($orderdetail->book->image))
                                                <a href="{{ route('books.show', $orderdetail->book_id) }}"><img src="/storage/book_images/{{ $orderdetail->book->image }}"></a>
                                            @else
                                                <a href="{{ route('books.show', $orderdetail->book_id) }}"><img src="/img/product/sm-3/1.jpg"></a>
                                            @endif
                                        </td>
                                        <td class="product-name">
                                            <a href="{{ route('books.show', $orderdetail->book_id) }}">{{ $orderdetail->book->name }}</a>
                                        </td>
                                        <td class="product-price">
                                            <span>${{ $orderdetail->sell_price }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <span>{{ $orderdetail->quantity }}</span>
                                        </td>
                                        <td class="product-subtotal">${{ $orderdetail->sell_price * $orderdetail->quantity }}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            @endif

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

        var quantityInput = document.getElementsByClassName('book-quantity')
        for (i = 0; i < quantityInput.length; i++) {
            var input = quantityInput[i]
            input.addEventListener('change', function (event) {
                var value = event.target
                if (isNaN(value.value) || value.value <= 0) {
                    value.value = 1
                }
                updateCartTotal()
            });
        }

        function updateCartTotal() {
            var cartItemContainer = document.getElementsByClassName('each-cart')
            var total = 0

            for (var i = 0; i < cartItemContainer.length; i++) {
                var quantityElement = cartItemContainer[i].getElementsByClassName('book-quantity')[0];
                var priceElement = cartItemContainer[i].getElementsByClassName('amount')[0];

                var quantity = quantityElement.value
                var price = priceElement.innerText.replace('$', '')

                cartItemContainer[i].getElementsByClassName('product-subtotal').item(0).innerHTML = '$' + quantity * price
                total += quantity * price
            }
            document.getElementsByClassName('cart__total__tk').item(0).getElementsByTagName('li').item(0).innerHTML = '$' + total
        }


        function order() {
            var cartItemContainer = document.getElementsByClassName('each-cart')

            if (cartItemContainer.length) {
                for (var i = 0; i < cartItemContainer.length; i++) {
                    var input = document.createElement("input");
                    var input1 = document.createElement("input");

                    var quantityElement = cartItemContainer[i].getElementsByClassName('book-quantity')[0];
                    var idElement = cartItemContainer[i].getElementsByClassName('book-id')[0];
                    var quantity = quantityElement.value
                    var book_id = idElement.value

                    // set input
                    input.setAttribute("type", "hidden");
                    var name = "books[:i][id]"
                    name = name.replace(':i', i)
                    input.setAttribute("name", name);
                    input.setAttribute("value", book_id);
                    document.getElementById("order-form").appendChild(input);

                    input1.setAttribute("type", "hidden");
                    var name = "books[:i][quantity]"
                    name = name.replace(':i', i)
                    input1.setAttribute("name", name);
                    input1.setAttribute("value", quantity);
                    document.getElementById("order-form").appendChild(input1);
                }
                document.getElementById("order-form").submit();
            }
        }
    </script>

@endsection
