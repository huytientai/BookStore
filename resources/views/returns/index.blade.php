@extends('layouts.admin')

@section('title', 'Returns list')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">

    <div class="cart-main-area section-padding--lg bg--white">
        <br>
        <h2>Returns List</h2>
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
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <b>Returns Ship Info:</b>
                                            <div style="margin-left: 10px">
                                                <div>Ship Merchant: {{ $order->returns->ship_merchant }}</div>
                                                <div>Ship ID: {{ $order->returns->ship_id }}</div>
                                                <div>IMG:</div>
                                                @if($order->returns->image == null)
                                                    <p>No IMG</p>
                                                @else
                                                    <img style="width: 300px;height: 300px" src="{{ asset('storage\returns_images\\' . $order->returns->image) }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div>Returns Status: {{ \App\Models\Returns::$status[$order->returns->status] }}</div>
                                            <div class="row">
                                                @if($order->returns->status == \App\Models\Returns::WAITING)
                                                    @canany(['seller','staff','admin'])
                                                        <a href="{{ route('returns.check', $order->id) }}" class="btn btn-primary">Check</a>
                                                        <form action="{{ route('returns.destroy',$order->id) }}" method="post" style="margin-bottom: 0rem;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">Cancel</button>
                                                        </form>
                                                    @endcanany
                                                @elseif($order->returns->status == \App\Models\Returns::CHECKED)
                                                    @canany(['seller','staff','admin'])
                                                        <a href="{{ route('returns.requestGetReturns', $order->id) }}" class="btn btn-primary">Request get returns</a>
                                                    @endcan
                                                @elseif($order->returns->status == \App\Models\Returns::REQUEST)
                                                    @can('warehouseman')
                                                        <a href="{{ route('returns.confirmGetReturns', $order->id) }}" class="btn btn-primary">Confirm get returns</a>
                                                    @endcan
                                                @elseif($order->returns->status == \App\Models\Returns::CONFIRM)
                                                    @canany(['seller','staff','admin'])
                                                        <a href="{{ route('returns.done',$order->id) }}" class="btn btn-primary">Done</a>
                                                    @endcanany
                                                @elseif($order->returns->status == \App\Models\Returns::DONE)

                                                @endif
                                            </div>
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
        sidebar.getElementsByTagName('li').item(8).classList.add('active');
    </script>
@endsection
