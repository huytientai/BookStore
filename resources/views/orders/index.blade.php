@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">

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
                        <siv class="col-auto" style="padding-top: 4px">
                            <select class="browser-default custom-select mr-sm-0" name="deleted" style="height: 37px">
                                <option value="">Deleted</option>
                                <option value="true" {{ (request('deleted') == "true") ? 'selected' : '' }}>True</option>
                                <option value="false" {{ (request('deleted') == "false") ? 'selected' : '' }}>False</option>
                            </select>
                        </siv>

                    </div>

                    <button class="btn btn-primary my-2 my-sm-10 container d-flex justify-content-center" type="submit">Search</button>
                </form>
            </div>

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
                                                <div class="">Status: {{ \App\Models\Order::$status[\App\Models\Order::WAITING] }}</div>
                                            @elseif($order->status == \App\Models\Order::CHECKED)
                                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::CHECKED] }}</div>
                                            @elseif($order->status == \App\Models\Order::SHIPPING)
                                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::SHIPPING] }}</div>
                                            @else
                                                <div>Status: {{  \App\Models\Order::$status[\App\Models\Order::DONE] }}</div>
                                            @endif
                                        </div>
                                        <div class="col-sm">
                                            @if($order->deleted_at == null)
                                                @if($order->status == \App\Models\Order::WAITING)
                                                    <div class="row">
                                                        <a class="btn btn-primary" href="{{ route('orders.check',$order->id) }}">Check</a>
                                                        <form action="{{ route('orders.destroy',$order->id) }}" method="post" style="margin-bottom: 0rem;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">Cancel</button>
                                                        </form>
                                                    </div>
                                                @elseif($order->status == \App\Models\Order::CHECKED)
                                                    <div class="row">
                                                        <a class="btn btn-primary" href="{{ route('orders.shipping',$order->id) }}">Shipping</a>
{{--                                                        <a class="btn btn-danger" href="{{ route('orders.revertToWaiting',$order->id) }}">Revert to Waiting</a>--}}
                                                    </div>
                                                @elseif($order->status == \App\Models\Order::SHIPPING)
                                                    <div class="row">
                                                        <a class="btn btn-primary" href="{{ route('orders.finish',$order->id) }}">Finish</a>
                                                        <a class="btn btn-danger" href="{{ route('orders.revertToChecked',$order->id) }}">Revert to Checked</a>
                                                    </div>
                                                @else
                                                    <a class="btn btn-danger" href="{{ route('orders.revertToShipping',$order->id) }}">Revert to Shipping</a>
                                                @endif
                                            @else
                                                <button class="btn btn-dark" style="cursor: not-allowed;">Canceled</button>
                                            @endif
                                        </div>
                                    </div>

                                    @if($order->status != \App\Models\Order::WAITING && $order->deleted_at == null)
                                        <div class="row">
                                            <div class="col-sm">{{ ($order->status==\App\Models\Order::CHECKED || $order->status==\App\Models\Order::SHIPPING ? 'Checked by: ' :'Finished by: ') . $order->finished->name }}</div>
                                            @if($order->status == \App\Models\Order::CHECKED)
                                                <div class="col-sm">
                                                    <div class="row">
                                                        <a class="btn btn-warning" href="{{ route('orders.edit',$order->id) }}">Edit</a>
                                                        <form action="{{ route('orders.destroy',$order->id) }}" method="post" style="margin-bottom: 0rem;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
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
