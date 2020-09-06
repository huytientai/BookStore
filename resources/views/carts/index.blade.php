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
                                            <input type="hidden" class="book-id" name="book-id" value="{{ $cart->book_id }}">
                                        </td>
                                        <td class="product-subtotal">${{ $cart->book->price * $cart->quantity }}</td>
                                        <td class="product-remove">
                                            <button type="button" class="btn btn-danger btn_remove">X</button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="cartbox__btn">
                        <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                            <li><a href="#">Coupon Code</a></li>
                            <li><a href="#">Apply Code</a></li>
                            <li>
                                <form action="{{ route('carts.update', 1) }}" id="update-form" method="post">
                                    @csrf
                                    @method('PUT')
                                    <a type="button" class="btn cart__total__amount" style="width: 100%" onclick="update_cart()">Update Cart</a>
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('checkout.index') }}" id="checkout-form" method="post">
                                    @csrf
                                    <a type="button" class="btn" style="width: 100%" onclick="checkout()">Check Out</a>
                                </form>
                            </li>
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
                        {{--                        <form action="{{ route('carts.update', 1) }}" id="order-form" method="post">--}}
                        {{--                            @csrf--}}
                        {{--                            @method('PUT')--}}
                        {{--                            <button type="button" class="btn cart__total__amount" style="width: 100%" onclick="order()">Grand Total</button>--}}
                        {{--                        </form>--}}
                        <div class="cart__total__amount">
                            <span>Grand Total</span>
                            <span class="grand__total__tk">$</span>
                        </div>
                    </div>
                </div>
            </div>


            {{--                current order--}}
            <br><br><br>
            <hr>
            <br>
            <h2>Current Order</h2>
            <br>
            <ul style="list-style-type:disc;">

                @if(isset($orders[0]))
                    @foreach($orders as $order)
                        <div>
                            <li class="orders" style="cursor:pointer">#Order{{ $order->id }} ({{ $order->created_at }})</li>
                            <div class="row order-details" style="display: none">
                                <div class="col-md-12 col-sm-12 ol-lg-12">
                                    <div>Status: {{ \App\Models\Order::$status[$order->status] }}</div>
                                    <div>Paid: {{ $order->pay_status ? 'Yes':'No' }}</div>
                                    @if($order->pay_status)
                                        <div>Payment: {{ $order->payment }}</div>
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-sm">Name: {{ $order->name }}</div>
                                        <div class="col-sm">Address: {{ $order->address }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">Phone: {{ $order->phone }}</div>
                                        <div class="col-sm">Email: {{ $order->email }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div>Company: {{ $order->company }}</div>
                                            <br>
                                            
                                            <div>Ship Fee: {{ $order->ship_fee }}$</div>
                                            <div @if($order->discount_id != null) title="Code: {{ \App\Models\Discount::withTrashed()->find($order->discount_id)->code }}" @endif>Discount: {{ $order->discount ? $order->discount : 0 }}$</div>
                                            <div>Total: {{ $order->total_price }}$</div>
                                        </div>
                                        @if(($order->status < \App\Models\Order::CONFIRM) && ($order->deleted_at == null))
                                            <div class="col-sm">
                                                <br>
                                                <div class="row">
                                                    <a href="{{ route('orders.userEdit',$order->id) }}" class="btn btn-primary">Edit</a>

                                                    <form action="{{ route('orders.userCancel',$order->id) }}" method="post" style="margin-bottom: 0rem;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Cancel</button>
                                                    </form>
                                                </div>
                                                <small>Note: you will lose 10% of the bill for fee if you cancel.</small>
                                            </div>
                                        @endif

                                        @if($order->deleted_at != null)
                                            <div class="col-sm">
                                                <br>
                                                <div class="row">
                                                    <button class="btn btn-dark" style="cursor: not-allowed">Cancelled</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <br>

                                    <div>Created At: {{ $order->created_at }}</div>
                                    <br>

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
                                            @foreach($order->orderdetails as $orderdetail)
                                                <tr @if($orderdetail->book->deleted_at)style="background-color: #9c9692" @endif>
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
                                <br>
                            </div>
                        </div>
                    @endforeach
                @endif

            </ul>
        </div>
    </div>

    <script>
        updateCartTotal()

        var removeCartItemButtons = document.getElementsByClassName('btn_remove');
        for (var i = 0; i < removeCartItemButtons.length; i++) {
            var button = removeCartItemButtons[i];
            button.addEventListener('click', function (event) {
                var buttonClicked = event.target
                buttonClicked.parentElement.parentElement.remove()
                updateCartTotal()
            })
        }

        var orders = document.getElementsByClassName('orders')
        for (var i = 0; i < orders.length; i++) {
            var toggle = orders[i];
            toggle.addEventListener('click', function (event) {
                var clicked = event.target
                var x = clicked.parentElement.getElementsByClassName('order-details').item(0)
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
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
            document.getElementsByClassName('grand__total__tk').item(0).innerHTML = '$' + total

        }

        function update_cart() {
            var cartItemContainer = document.getElementsByClassName('each-cart')
            if (cartItemContainer.item(0) == null) {
                return document.getElementById("update-form").submit();
                ;
            }

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
                    document.getElementById("update-form").appendChild(input);

                    input1.setAttribute("type", "hidden");
                    var name = "books[:i][quantity]"
                    name = name.replace(':i', i)
                    input1.setAttribute("name", name);
                    input1.setAttribute("value", quantity);
                    document.getElementById("update-form").appendChild(input1);
                }

                document.getElementById("update-form").submit();
            }
        }

        function checkout() {
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
                    document.getElementById("checkout-form").appendChild(input);

                    input1.setAttribute("type", "hidden");
                    var name = "books[:i][quantity]"
                    name = name.replace(':i', i)
                    input1.setAttribute("name", name);
                    input1.setAttribute("value", quantity);
                    document.getElementById("checkout-form").appendChild(input1);
                }
                document.getElementById("checkout-form").submit();
            }
        }

    </script>

@endsection
