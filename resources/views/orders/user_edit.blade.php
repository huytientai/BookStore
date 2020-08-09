@extends('exam1.default')

@section('title', 'Edit Order')

@section('content')
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">
            @include('flash::message')
            <br>

            @php
                $warn=0;
                foreach($order->orderdetails as $orderdetail)
                {
                if($orderdetail->book->deleted_at!=null){
                $warn=1;
                break;
                }
                }
            @endphp

            <h3 @if($order->status == \App\Models\Order::CHECKED && $warn) style="background-color:yellow;" @endif>#Order{{ $order->id }}</h3>
            <div class="row order-details">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <form action="{{ route('orders.userUpdate', $order->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm">Name:
                                <input type="text" class="form-control" name="name" value="{{ $order->name }}" required>
                            </div>
                            <div class="col-sm">
                                <p>Account: {{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">Phone:
                                <input type="text" class="form-control" name="phone" value="{{ $order->phone }}" required>
                            </div>

                            <div class="col-sm">Email:
                                <input type="text" class="form-control" name="email" value="{{ $order->email }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">Address:
                                <input type="text" class="form-control" name="address" value="{{ $order->address }}" list="addresses-list" required>
                                @php($addresses_list = [Auth::user()->address,Auth::user()->address1,Auth::user()->address2,Auth::user()->address3])
                                @php($addresses_list = array_filter($addresses_list))

                                @if($addresses_list != null)
                                    <datalist id="addresses-list">
                                        @foreach($addresses_list as $address_list)
                                            <option value="{{ $address_list }}">
                                        @endforeach
                                    </datalist>
                                @endif
                            </div>
                            <div class="col-sm"> Company:
                                <input type="text" class="form-control" name="company" value="{{ $order->company }}">
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('carts.index') }}" class="btn btn-danger">Cancel</a>
                    </form>
                    <br>
                    <div></div>
                    <div class="row">
                        <div class="col-sm">
                            <div>Total: <b id="order-total">{{ $order->total_price }}$</b></div>
                            @if($order->status == \App\Models\Order::WAITING)
                                <div class="">Status: {{ \App\Models\Order::$status[\App\Models\Order::WAITING] }}</div>
                            @elseif($order->status == \App\Models\Order::CHECKED)
                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::CHECKED] }}</div>
                            @elseif($order->status == \App\Models\Order::SHIPPING)
                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::SHIPPING] }}</div>
                            @else
                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::DONE] }}</div>
                            @endif
                        </div>
                    </div>

                    @if($order->status != \App\Models\Order::WAITING)
                        <div class="row">
                            <div class="col-sm">{{ ($order->status==\App\Models\Order::CHECKED || $order->status==\App\Models\Order::SHIPPING ? 'Checked by: ' :'Finished by: ') . $order->seller->name }}</div>
                            @if($order->status == \App\Models\Order::CHECKED)
                                <div class="col-sm">
                                    <div class="row">
                                        <form action="{{ route('orders.update', $order->id) }}" id="update-form" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-warning" onclick="update_cart()">Update</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <br>

                    <div>Created At: {{ $order->created_at }}</div>
                    <br>

                    <br><br>
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
                                    @foreach($order->orderdetails as $orderdetail)
                                        <tr class="each-cart" @if($orderdetail->book->deleted_at)style="background-color: #9c9692" @endif>
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
                                                <span class="amount">${{ $orderdetail->book->price }}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <span class="book-quantity" style="font-size: 16px;font-weight: 700;color: #333333">{{ $orderdetail->quantity }}</span>
                                            </td>
                                            <td class="product-subtotal">${{ $orderdetail->book->price * $orderdetail->quantity }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(4).classList.add('active');

        let quantityInput = document.getElementsByClassName('book-quantity')
        for (i = 0; i < quantityInput.length; i++) {
            let input = quantityInput[i]
            input.addEventListener('change', function (event) {
                let value = event.target
                if (isNaN(value.value) || value.value <= 0) {
                    value.value = 1
                }
                updateCartTotal()
            });
        }

        let rm_buttons = $(".product-remove .btn-danger")
        for (let i = 0; i < rm_buttons.length; i++) {
            let button = rm_buttons[i]
            button.addEventListener('click', function (event) {
                var buttonClicked = event.target
                buttonClicked.parentElement.parentElement.remove()
                updateCartTotal()
            })
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
            document.getElementById('order-total').innerHTML = total + '$'
        }
    </script>
@endsection
