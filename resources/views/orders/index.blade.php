@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <style>
        .table-content table {
            background: #fff none repeat scroll 0 0;
            border-color: #eaeaea;
            border-radius: 0;
            border-style: solid;
            border-width: 1px 0 0 1px;
            text-align: center;
            width: 100%;
        }

        .table-content table th {
            border-top: medium none;
            font-weight: bold;
            padding: 20px 10px;
            text-align: center;
            text-transform: uppercase;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table-content table th, .table-content table td {
            border-bottom: 1px solid #eaeaea;
            border-right: 1px solid #eaeaea;
        }

        .table-content table td {
            border-top: medium none;
            font-size: 13px;
            padding: 20px 10px;
            text-align: center;
            vertical-align: middle;
        }

        .table-content table td input {
            background: #e5e5e5 none repeat scroll 0 0;
            border: medium none;
            border-radius: 3px;
            color: #333;
            font-size: 15px;
            font-weight: normal;
            height: 40px;
            padding: 0 5px 0 10px;
            width: 60px;
        }

        .table-content table td.product-subtotal {
            font-size: 16px;
            font-weight: bold;
            width: 120px;
            color: #333;
        }

        .table-content table td.product-name a {
            font-size: 14px;
            font-weight: 700;
            margin-left: 10px;
            color: #333;
        }

        .table-content table td.product-name {
            width: 270px;
        }

        .table-content table td.product-thumbnail {
            width: 130px;
        }

        .table-content table td.product-remove i {
            color: #919191;
            display: inline-block;
            font-size: 20px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            width: 40px;
        }

        .table-content table .product-price .amount {
            font-size: 16px;
            font-weight: 700;
            color: #333;
        }

        .table-content table td.product-remove i:hover {
            color: #252525;
        }

        .table-content table td.product-quantity {
            width: 180px;
        }

        .table-content table td.product-remove {
            width: 150px;
        }

        .table-content table td.product-price {
            width: 130px;
        }

        .table-content table td.product-name a:hover {
            color: #e59285;
        }

        .table-content table .title-top th {
            background: #f6f6f6 none repeat scroll 0 0;
            border-bottom: 1px solid transparent;
            border-right: 1px solid transparent;
            color: #333;
        }

        .wnro__table table {
            border: 1px solid #e1e1e1;
        }

        /*.wnro__table th .nobr {*/
        /*    color: #2e2e2e;*/
        /*    display: inline-block;*/
        /*    font-size: 16px;*/
        /*    font-weight: 600;*/
        /*    padding: 20px 0;*/
        /*    text-transform: uppercase; }*/
        /*.wnro__table tbody td.product-remove a {*/
        /*    color: #3f3f3f;*/
        /*    display: block;*/
        /*    font-weight: 700;*/
        /*    height: 1em;*/
        /*    line-height: 1;*/
        /*    padding: 10px 0;*/
        /*    text-align: center; }*/
        /*.wnro__table tbody td.product-remove {*/
        /*    padding-right: 0;*/
        /*    text-align: center;*/
        /*    width: 40px; }*/

        .table-content table .title-top th {
            background: #f6f6f6 none repeat scroll 0 0;
            border-bottom: 1px solid transparent;
            border-right: 1px solid transparent;
            color: #333;
        }

        .table-content table td.product-thumbnail {
            width: 130px;
        }

        .product-thumbnail {
            padding: 25px 0;
        }

        .product-name a {
            color: #333444;
            font-size: 14px;
            font-weight: 500;
        }

        .table-content table td.product-name a {
            font-size: 14px;
            font-weight: 700;
            margin-left: 10px;
            color: #333;
        }

        .table-content table td.product-name {
            width: 270px;
        }

        .table-content table td.product-name a:hover {
            color: #e59285;
        }

        .table-content table td.product-name a:hover {
            color: #e59285;
        }

        .table-content table td.product-price {
            width: 130px;
        }

        .table-content table td.product-quantity {
            width: 180px;
        }

        .table-content table td.product-subtotal {
            font-size: 16px;
            font-weight: bold;
            width: 120px;
            color: #333;
        }
    </style>

    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            @include('flash::message')
            <br>
            <h2>Orders List</h2>
            <br>

            <div class="container">
                <form action="{{ route('orders.index') }}" class="form-group" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-auto">
                            <input class="form-control mr-sm-0" type="search" placeholder="Order ID" name="order_id" value="{{ request('order_id') }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control mr-sm-0" type="search" placeholder="Name" name="name" value="{{ request('name') }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control mr-sm-0" type="search" placeholder="User Id" name="user_id" value="{{ request('user_id') }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control mr-sm-0" type="search" placeholder="Phone" name="phone" value="{{ request('phone') }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control mr-sm-0" type="search" placeholder="Email" name="email" value="{{ request('email') }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control mr-sm-0" type="search" placeholder="Address" name="address" value="{{ request('address') }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control mr-sm-0" type="search" placeholder="Company" name="company" value="{{ request('company') }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control mr-sm-0" type="date" name="date" value="{{ request('date') }}">
                        </div>
                        <div class="col-auto" style="padding-top: 4px">
                            <select class="browser-default custom-select mr-sm-0" name="status" style="height: 37px">
                                <option value="">Status</option>
                                @foreach(\App\Models\Order::$status as $key => $value)
                                    <option value="{{ $key }}" {{ ((request('status') ?? -1) == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <button class="btn btn-primary my-2 my-sm-10 container d-flex justify-content-center" type="submit">Search</button>
                </form>
            </div>

            <br>

            <ol>
                @if(count($orders))
                    @foreach($orders as $order)
                        <div>
                            <li class="orders" style="cursor: pointer;">#Order{{ $order->id }} ({{ $order->created_at }})</li>
                            <div class="row order-details" style="display: none">
                                <div class="col-md-12 col-sm-12 ol-lg-12">
                                    <div class="row">
                                        <div class="col-sm">Name: {{ $order->name }}</div>
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
                                            @if($order->status == \App\Models\Order::WAITING)
                                                <div>Status: {{ \App\Models\Order::$status[\App\Models\Order::WAITING] }}</div>
                                            @elseif($order->status == \App\Models\Order::CHECKED)
                                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::CHECKED] }}</div>
                                            @elseif($order->status == \App\Models\Order::SHIPPING)
                                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::SHIPPING] }}</div>
                                            @else
                                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::DONE] }}</div>
                                            @endif
                                        </div>
                                        <div class="col-sm">
                                            @if($order->status == \App\Models\Order::WAITING)
                                                <div class="row">
                                                    <a class="btn btn-primary" href="{{ route('orders.check',$order->id) }}">Check</a>
                                                </div>
                                            @elseif($order->status == \App\Models\Order::CHECKED)
                                                <div class="row">
                                                    <a class="btn btn-primary" href="{{ route('orders.shipping',$order->id) }}">Shipping</a>
                                                    <a class="btn btn-danger" href="{{ route('orders.revertToWaiting',$order->id) }}">Revert to Waiting</a>
                                                </div>
                                            @elseif($order->status == \App\Models\Order::SHIPPING)
                                                <div class="row">
                                                    <a class="btn btn-primary" href="{{ route('orders.finish',$order->id) }}">Finish</a>
                                                    <a class="btn btn-danger" href="{{ route('orders.revertToChecked',$order->id) }}">Revert to Checked</a>
                                                </div>
                                            @else
                                                <a class="btn btn-danger" href="{{ route('orders.revertToShipping',$order->id) }}">Revert to Shipping</a>
                                            @endif
                                        </div>
                                    </div>

                                    @if($order->status != \App\Models\Order::WAITING)
                                        <div>{{ ($order->status==\App\Models\Order::CHECKED || $order->status==\App\Models\Order::SHIPPING ? 'Checked by: ' :'Finished by: ') . $order->finished->name }}</div>
                                    @endif
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
    <script>
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
        sidebar.getElementsByTagName('li').item(4).classList.add('active');
    </script>
@endsection
