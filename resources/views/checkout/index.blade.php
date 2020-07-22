@extends('exam1.default')

@section('title', 'Checkout')

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
                            <form action="#">
                                <div class="form__coupon">
                                    <input type="text" placeholder="Coupon code">
                                    <button>Apply coupon</button>
                                </div>
                            </form>
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
                                    <label>Address <span>*</span></label>
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

                            <button type="submit" class="btn cart__total__amount" style="width: 100%">Cash on Delivery</button>
                        </form>
                    </div>
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
                            <li>Shipping
                                <ul>
                                    <li>
                                        <input name="shipping_method[0]" data-index="0" value="legacy_flat_rate" checked="checked" type="radio">
                                        <label>Nomal</label>
                                    </li>
                                    <li>
                                        <input name="shipping_method[0]" data-index="0" value="legacy_flat_rate" type="radio">
                                        <label>Fast(2h)</label>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="total__amount">
                            <li>Order Total <span>${{ $total }}</span></li>
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
                                    <span>Cheque Payment</span>
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="payment-body">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</div>
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
                                    <span>PayPal <img src="{{ asset('img/icons/payment.png') }}" alt="payment images"> </span>
                                </a>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="payment-body">Pay with cash upon delivery.</div>
                                <div class="payment-body" style="cursor: pointer;color: #0b75c9" id="momo">MoMo</div>
                            </div>
                            <div></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('momo').addEventListener('click', function () {
            changePaymnet('{{ route('checkout.momo') }}', 'Checkout By MoMo')
        });

        document.getElementById('headingThree').addEventListener('click', function () {
            changePaymnet('{{ route('checkout.store') }}', 'Cash on Delivery')
        });

        function changePaymnet($form, $button) {
            let checkout_form = document.getElementById('checkout-form');
            checkout_form.action = $form;
            checkout_form.getElementsByTagName('button').item(0).innerHTML = $button;
        }
    </script>
@endsection
