@extends('exam1.default')

@section('title', 'Checkout')
@section('style')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoFSvjKPJMynwCntJ34AJtNscYMv-JsOc"
        defer
    ></script>
@endsection

@section('content')

    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wn_checkout_wrap">
                        {{--                        <div class="checkout_info">--}}
                        {{--                            <span>Returning customer ?</span>--}}
                        {{--                            <a class="showlogin" href="#">Click here to login</a>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="checkout_login">--}}
                        {{--                            <form class="wn__checkout__form" action="#">--}}
                        {{--                                <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>--}}

                        {{--                                <div class="input__box">--}}
                        {{--                                    <label>Username or email <span>*</span></label>--}}
                        {{--                                    <input type="text">--}}
                        {{--                                </div>--}}

                        {{--                                <div class="input__box">--}}
                        {{--                                    <label>password <span>*</span></label>--}}
                        {{--                                    <input type="password">--}}
                        {{--                                </div>--}}
                        {{--                                <div class="form__btn">--}}
                        {{--                                    <button>Login</button>--}}
                        {{--                                    <label class="label-for-checkbox">--}}
                        {{--                                        <input id="rememberme" name="rememberme" value="forever" type="checkbox">--}}
                        {{--                                        <span>Remember me</span>--}}
                        {{--                                    </label>--}}
                        {{--                                    <a href="#">Lost your password?</a>--}}
                        {{--                                </div>--}}
                        {{--                            </form>--}}
                        {{--                        </div>--}}
                        <div class="checkout_info">
                            <span>Have a coupon? </span>
                            <a class="showcoupon" href="#">Click here to enter your code</a>
                        </div>
                        <div class="checkout_coupon">
                            <div class="form__coupon">
                                <input type="text" placeholder="Coupon code" id="code">
                                <button id="checkCode" type="button" onclick="checkCode()">Apply coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="customer_details">
                        <h3>Billing details</h3>
                        <form action="{{ route('checkout.store') }}" id="checkout-form" method="post">
                            @csrf
                            @php($i=0)
                            <div class="customar__field">

                                <div class="margin_between">
                                    <div class="input_box space_between">
                                        <label>Name <span>*</span></label>
                                        <input type="text" name="name" id="user-name-checkout" value="{{ Auth::user()->name }}" required>
                                    </div>

                                </div>
                                <div class="input_box">
                                    <label>Company name <span></span></label>
                                    <input type="text" name="company" id="company-checkout">
                                </div>

                                <div class="input_box">
                                    <label>Address (shipFee=km * 2.000d /20.000)<span>*</span></label>
                                    <input type="text" name="address" id="address-checkout" placeholder="delivery location" list="addresses-list" required>
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


                                <div class="margin_between">
                                    <div class="input_box space_between">
                                        <label>Phone <span>*</span></label>
                                        <input type="number" name="phone" id="phone-checkout" value="{{ Auth::user()->phone }}" required>
                                    </div>

                                    <div class="input_box space_between">
                                        <label>Email address <span>*</span></label>
                                        <input type="email" name="email" id="email-checkout" value="{{ Auth::user()->email }}" required>
                                    </div>
                                </div>
                            </div>

                            @foreach($books as $book)
                                <input type="hidden" name="books[{{$i}}][id]" value="{{ $book->id }}">
                                <input type="hidden" name="books[{{$i++}}][quantity]" value="{{ $book->quantity }}">
                            @endforeach
                            <input type="hidden" name="discount" id="discount">
                            <input type="hidden" name="shipFee" id="ship">

                            <button type="submit" class="btn cart__total__amount" style="width: 100%">Cash on Delivery</button>
                        </form>
                    </div>

                    <br><br>
                    {{--                    <iframe--}}
                    {{--                        width="100%"--}}
                    {{--                        height="450"--}}
                    {{--                        frameborder="0" style="border:0"--}}
                    {{--                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAoFSvjKPJMynwCntJ34AJtNscYMv-JsOc&q=Quảng+Trường+C1,+Đại+Học+Bách+Khoa+Hà+Nội" allowfullscreen>--}}
                    {{--                                                src="https://www.google.com/maps/embed/v1/view?key=AIzaSyAoFSvjKPJMynwCntJ34AJtNscYMv-JsOc&center=21.006242,105.843127&zoom=18" allowfullscreen--}}
                    {{--                    </iframe>--}}
                </div>
                <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__order__box">
                        <h3 class="onder__title">Your order</h3>
                        <ul class="order__total">
                            <li>Product</li>
                            <li>Total</li>
                        </ul>
                        <ul class="order_product">
                            @php($total=0)
                            @foreach($books as $book)
                                <li>
                                    <a href="{{ route('books.show', $book->id) }}">{{ $book->name }}</a> × {{ $book->quantity }}
                                    <span>${{ $book->price * $book->quantity }}</span></li>
                                @php($total+= $book->price * $book->quantity)
                            @endforeach
                        </ul>
                        <ul class="shipping__method">
                            <li>Cart Subtotal <span>${{ $total }}</span></li>
                            <li>Discount <span id="discount-order">$0</span></li>
                            <li>Shipping
                                <span id="ship-order">$0</span>
                            </li>
                        </ul>
                        <ul class="total__amount">
                            <li>Order Total <span class="row">$<p id="order-total">{{ $total }}</p></span></li>
                        </ul>
                    </div>
                    <div id="accordion" class="checkout_accordion mt--30" role="tablist">
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingOne">
                                <a class="checkout__title" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Direct Bank Transfer</span>
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="payment-body">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</div>
                            </div>
                        </div>
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingTwo">
                                <a class="collapsed checkout__title" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>Use Point</span>
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="payment-body">Your Point: {{ Auth::user()->point }}
                                    <img src="{{ asset('img/icons/coin-icon.jpg') }}" style="width: 25px"></div>
                                {{--                                @if(Auth::user()->point >= $total)--}}
                                {{--                                    <button class="btn btn-primary" onclick="usePoint()" id="use_point">Use</button>--}}
                                {{--                                @else--}}
                                {{--                                    <small class="text-danger" style="padding-left: 10px">Not enough point</small>--}}
                                {{--                                @endif--}}
                                <button class="btn btn-primary" onclick="usePoint()" id="use_point">Use</button>
                                <small class="text-danger" style="padding-left: 10px" id="check_point"></small>

                            </div>
                        </div>
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingThree">
                                <a class="collapsed checkout__title" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span>Cash on Delivery</span>
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="payment-body">Pay with cash upon delivery.</div>
                            </div>
                        </div>
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingFour">
                                <a class="collapsed checkout__title" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span>PayPal <small>(Save 3% into your point) </small><img src="{{ asset('img/icons/payment.png') }}" alt="payment images"> </span>
                                </a>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="payment-body">Pay with cash upon delivery.</div>
                                <div class="payment-body" style="cursor: pointer;color: #0b75c9" id="momo">MoMo</div>
                                <div class="payment-body" style="cursor: pointer;color: #0b75c9" id="vnpay">VNPay</div>
                            </div>
                            <div></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        function checkCode() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('discount.checkCode') }}",
                type: "post",
                data: {'code': $("#code").val()},
                success: function (result) {
                    if (!result) {
                        if ($("#code").css('border') != 'solid red') {
                            $("#code").css('border', "solid red");
                        }
                        return;
                    }

                    let keys = ['code', 'discount', 'start_time', 'end_time', 'price_condition', 'num_condition',]
                    let data = []
                    keys.forEach(function (key) {
                        data[key] = $(result).find(key).text()
                    })

                    //check code
                    if (new Date(data['start_time']) > Date.now()) {
                        if ($("#code").css('border') != 'solid red') {
                            $("#code").css('border', 'solid red');
                        }
                        alert("this code start at " + data['start_time']);
                        return;
                    }
                    if (new Date(data['end_time']) < Date.now()) {
                        if ($("#code").css('border') != 'solid red') {
                            $("#code").css('border', 'solid red');
                        }
                        alert("This code is expired");
                        return;
                    }

                    if (parseFloat(data['price_condition']) > {{ $total }} ) {
                        if ($("#code").css('border') != 'solid red') {
                            $("#code").css('border', 'solid red');
                        }
                        alert("Price condition >= " + data['price_condition']);
                        return;
                    }

                    if (data['num_condition'] == '0') {
                        if ($("#code").css('border') != 'solid red') {
                            $("#code").css('border', 'solid red');
                        }
                        alert("Out of turn to use");
                        return;
                    }

                    // code is success
                    $("#code").css('border', 'solid blue');
                    $("#discount-order").text("$" + data['discount']);

                    $("#discount").val(data['code']);

                    update_order_total();
                },
                error: function (xhr, status, error) {
                    alert("Server not response.Please try again!");
                }
            })
        }

        document.getElementById('momo').addEventListener('click', function () {
            if ($("#order-total").text() == 0) {
                $("#headingThree").click();
                return;
            }
            changePaymnet('{{ route('checkout.momo') }}', 'Checkout By MoMo')
        });

        document.getElementById('vnpay').addEventListener('click', function () {
            if ($("#order-total").text() == 0) {
                $("#headingThree").click();
                return;
            }
            changePaymnet('{{ route('checkout.vnpay') }}', 'Checkout By VNPay')
        });

        document.getElementById('headingThree').addEventListener('click', function () {
            changePaymnet('{{ route('checkout.store') }}', 'Cash on Delivery')
        });

        function usePoint() {
            if ($("#order-total").text() == 0) {
                $("#headingThree").click();
                return;
            }

            let order_total = parseFloat($("#order-total").text());

            if (order_total > {{ Auth::user()->point }}) {
                $('#check_point').text("Not enough point");
            } else {
                $('#check_point').text("");
                changePaymnet('{{ route('checkout.point') }}', 'Checkout with point');
            }
        }

        function changePaymnet($form, $button) {
            let checkout_form = document.getElementById('checkout-form');
            checkout_form.action = $form;
            checkout_form.getElementsByTagName('button').item(0).innerHTML = $button;
        }


        $(document).ready(function () {
            $('#address-checkout').blur(function () {
                let origin = 'Quảng Trường C1, Đại Học Bách Khoa Hà Nội';

                let address = $('#address-checkout').val();
                address = $.trim(address)
                if (address == '') {
                    return;
                }
                let destination = address;

                let service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix(
                    {
                        origins: [origin],
                        destinations: [destination],
                        travelMode: 'DRIVING',
                    }, callback)

                function callback(response, status) {
                    let feePerKm = 2000;
                    $('#address-checkout').val(response.destinationAddresses[0]);
                    $('#ship-order').text("$" + (Math.ceil(response.rows[0].elements[0].distance.value / 1000 / 20000 * feePerKm * 100) / 100));
                    update_order_total();
                }
            })
        })

        function update_order_total() {
            let discount = parseFloat($('#discount-order').text().substring(1));
            let ship = parseFloat($('#ship-order').text().substring(1));

            let amount = {{ $total }} +ship;
            let order_total = 0;
            if (amount > discount) {
                order_total = Math.floor((amount - discount) * 100) / 100;
            } else {
                order_total = 0;
                $("#headingThree").click();
            }

            $('#order-total').text(order_total);
            $('#ship').val(ship);
        }
    </script>
@endsection
