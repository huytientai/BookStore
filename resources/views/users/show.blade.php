@extends('exam1.default')

@section('title', 'Profile')

@section('content')

    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form" class="minisearch" action="#">
            <div class="field__search">
                <input type="text" placeholder="Search entire store here...">
                <div class="action">
                    <a href="#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
    <!-- End Search Popup -->

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
                                        @if($user->avatar == null)
                                            <img src="{{ asset('storage/avatar/default.jpg') }}" alt="">
                                        @else
                                            <img src="{{ asset('storage/avatar/' . $user->avatar) }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="product__info__main">
                                    <h1>{{ $user->name }}</h1>

                                    <div class="product__overview">
                                        <p>Address: {{ $user->address }}</p>
                                        <p>Phone: {{ $user->phone }}</p>
                                        @if($user->role != \App\Models\User::GUESS)
                                            <p>Position: {{ \App\Models\User::$roles[$user->role] }}</p>
                                        @endif
                                        <br>
                                        <p>Address 1: {{ $user->address1 }}</p>
                                        <p>Address 2: {{ $user->address2 }}</p>
                                        <p>Address 3: {{ $user->address3 }}</p>

                                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End main Content -->

    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <br>
            <div>Point: {{ $user->point }} <img style="width: 25px" src="{{ asset('img/icons/coin-icon.jpg') }}"></div>

            <br>
            <h2>Your Bought</h2>
            <br>
            <ol>

                @if(isset($orders[0]))
                    @foreach($orders as $order)
                        <div>
                            <li class="orders" style="cursor: pointer;">#Order{{ $order->id }} ({{ $order->created_at }})</li>
                            <div class="row order-details" style="display: none">
                                <div class="col-md-12 col-sm-12 ol-lg-12">
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

                                            <div>Total: {{ $order->total_price }}$</div>
                                        </div>
                                        @if($order->status<\App\Models\Order::CONFIRM)
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
                                        <div class="col-sm">
                                            <br>
                                            @if($order->returns_request == \App\Models\Order::NO_RETURNS)
                                                <a href="{{ route('orders.createReturnsRequest', $order->id) }}" class="btn-sm btn-warning">Create returns request</a>
                                            @else
                                                <b>{{ \App\Models\Order::$returnsRequest[$order->returns_request] }}</b>
                                                @if($order->returns_request == \App\Models\Order::ACCEPTED_RETURNS)
                                                    <a href="{{ route('returns.create', ['order_id'=> $order->id]) }}" data-toggle="tooltip" title="After ship back returns,send ship info">
                                                        <button class="btn btn-primary">Send ship info</button>
                                                    </a>
                                                @elseif($order->returns_request == \App\Models\Order::DONE_RETURNS)
                                                    <a href="{{ route('returns.edit', $order->id) }}" data-toggle="tooltip" title="Edit Sent ship info">
                                                        <button class="btn btn-primary">Edit ship info</button>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                    <div>Status: {{  \App\Models\Order::$status[$order->status] }}</div>
                                    @canany(['admin','staff','seller'])
                                        @if($order->status!=\App\Models\Order::WAITING)
                                            <div>{{ ($order->status==\App\Models\Order::CHECKED || $order->status==\App\Models\Order::SHIPPING ? 'Checked by: ' :'Finished by: ') . $order->seller->name }}</div>
                                        @endif
                                    @endcan
                                    <br>

                                    <div>Shipped At: {{ $order->updated_at }}</div>
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
    </script>

    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form--2" class="minisearch" action="#">
            <div class="field__search">
                <input type="text" placeholder="Search entire store here...">
                <div class="action">
                    <a href="#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
    <!-- End Search Popup -->
@endsection
