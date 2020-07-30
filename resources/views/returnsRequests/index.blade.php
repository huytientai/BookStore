@extends('layouts.admin')

@section('title', 'Ruturns requests list')

@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <br>
        <h2>Returns Requests List</h2>
        <br>
        <div class="container">
            @include('flash::message')
            <br>
            <ol>
                @if(count($orders))
                    @foreach($orders as $order)
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
                        <div>
                            <li class="orders" style="cursor: pointer;@if($order->status == \App\Models\Order::CHECKED && $warn) background-color:yellow @endif">#Order{{ $order->id }} ({{ $order->created_at }})</li>
                            <div class="row order-details" style="display: none">
                                <div class="col-md-12 col-sm-12 ol-lg-12">
                                    <div class="row">
                                        <div class="col-sm">Name: {{ $order->user->name }}</div>
                                        <div class="col-sm">
                                            <a href="{{ route('users.show',$order->user_id) }}">User_Id: {{ $order->user_id }}</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">Phone: {{ $order->phone }}</div>

                                        <div class="col-sm">Email: {{ $order->email }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">Address: {{ $order->address }}</div>
                                        <div class="col-sm"> Company: {{ $order->company }}</div>
                                    </div>
                                    <br>
                                    <div></div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div>Total: {{ $order->total_price }}$</div>
                                            <div>Status: {{  \App\Models\Order::$status[$order->status] }}</div>
                                            <br>

                                            <b>{{ \App\Models\Order::$returnsRequest[$order->returns_request] }}</b>
                                        </div>
                                        <div class="col-sm">
                                            @if($order->deleted_at == null)
                                                @if($order->returns_request == \App\Models\Order::HAS_RETURNS)
                                                    <div class="row">
                                                        <form action="{{ route('orders.acceptReturnsRequest',$order->id) }}" method="post">
                                                            @csrf
                                                            <button class="btn btn-primary" type="submit">Accept</button>
                                                        </form>
                                                        <form action="{{ route('orders.deniesReturnsRequest',$order->id) }}" method="post">
                                                            @csrf
                                                            <button class="btn btn-danger" type="submit">Denies</button>
                                                        </form>
                                                    </div>
                                                    <div class="row">
                                                        <form action="{{ route('orders.cancelReturnsRequest',$order->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-light" type="submit">Cancel</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                <button class="btn btn-dark" style="cursor: not-allowed;">Canceled</button>
                                            @endif
                                        </div>
                                    </div>

                                    <br>

                                    <div>Created At: {{ $order->created_at }}</div>
                                    <br>

                                    <div class="table-content wnro__table table-responsive">
                                        <table>
                                            <thead>
                                            <tr class="title-top">
                                                <th class="product-thumbnail">Image</th>
                                                <th class="product-name" style="width: 270px;">Product</th>
                                                <th class="product-price" style="width: 130px;">Price</th>
                                                <th class="product-quantity" style="width: 180px">Quantity</th>
                                                <th class="product-subtotal" style="width: 120px;">Total</th>
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

                    <br>
                    {!! $orders->links() !!}
                @endif

            </ol>
        </div>
    </div>

    <script type="text/javascript">
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

        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(7).classList.add('active');
    </script>
@endsection
