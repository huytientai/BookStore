{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--        <title>Laravel</title>--}}

{{--        <!-- Fonts -->--}}
{{--        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}

{{--        <!-- Styles -->--}}
{{--        <style>--}}
{{--            html, body {--}}
{{--                background-color: #fff;--}}
{{--                color: #636b6f;--}}
{{--                font-family: 'Nunito', sans-serif;--}}
{{--                font-weight: 200;--}}
{{--                height: 100vh;--}}
{{--                margin: 0;--}}
{{--            }--}}

{{--            .full-height {--}}
{{--                height: 100vh;--}}
{{--            }--}}

{{--            .flex-center {--}}
{{--                align-items: center;--}}
{{--                display: flex;--}}
{{--                justify-content: center;--}}
{{--            }--}}

{{--            .position-ref {--}}
{{--                position: relative;--}}
{{--            }--}}

{{--            .top-right {--}}
{{--                position: absolute;--}}
{{--                right: 10px;--}}
{{--                top: 18px;--}}
{{--            }--}}

{{--            .content {--}}
{{--                text-align: center;--}}
{{--            }--}}

{{--            .title {--}}
{{--                font-size: 84px;--}}
{{--            }--}}

{{--            .links > a {--}}
{{--                color: #636b6f;--}}
{{--                padding: 0 25px;--}}
{{--                font-size: 13px;--}}
{{--                font-weight: 600;--}}
{{--                letter-spacing: .1rem;--}}
{{--                text-decoration: none;--}}
{{--                text-transform: uppercase;--}}
{{--            }--}}

{{--            .m-b-md {--}}
{{--                margin-bottom: 30px;--}}
{{--            }--}}
{{--        </style>--}}
{{--    </head>--}}
{{--    <body>--}}
{{--        <div class="flex-center position-ref full-height">--}}
{{--            @if (Route::has('login'))--}}
{{--                <div class="top-right links">--}}
{{--                    @auth--}}
{{--                        <a href="{{ url('/home') }}">Home</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('login') }}">Login</a>--}}

{{--                        @if (Route::has('register'))--}}
{{--                            <a href="{{ route('register') }}">Register</a>--}}
{{--                        @endif--}}
{{--                    @endauth--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <div class="content">--}}
{{--                <div class="title m-b-md">--}}
{{--                    Laravel--}}
{{--                </div>--}}

{{--                <div class="links">--}}
{{--                    <a href="https://laravel.com/docs">Docs</a>--}}
{{--                    <a href="https://laracasts.com">Laracasts</a>--}}
{{--                    <a href="https://laravel-news.com">News</a>--}}
{{--                    <a href="https://blog.laravel.com">Blog</a>--}}
{{--                    <a href="https://nova.laravel.com">Nova</a>--}}
{{--                    <a href="https://forge.laravel.com">Forge</a>--}}
{{--                    <a href="https://github.com/laravel/laravel">GitHub</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </body>--}}
{{--</html>--}}

@extends('exam.default')

@section('title', config('app.name'))

@section('content')
        <div class="templatemo_product_box">
            <h1>Photography <span>(by Best Author)</span></h1>
            <img src="{{ asset('img/templatemo_image_01.jpg') }}" alt="image"/>
            <div class="product_info">
                <p>Etiam luctus. Quisque facilisis suscipit elit. Curabitur...</p>
                <h3>$55</h3>
                <div class="buy_now_button"><a href="#">Buy Now</a></div>
                <div class="detail_button"><a href="#">Detail</a></div>
            </div>
            <div class="cleaner">&nbsp;</div>
        </div>

        <div class="cleaner_with_width">&nbsp;</div>

        <div class="templatemo_product_box">
            <h1>Cooking <span>(by New Author)</span></h1>
            <img src="{{ asset('img/templatemo_image_02.jpg') }}" alt="image"/>
            <div class="product_info">
                <p>Aliquam a dui, ac magna quis est eleifend dictum.</p>
                <h3>$35</h3>
                <div class="buy_now_button"><a href="#">Buy Now</a></div>
                <div class="detail_button"><a href="#">Detail</a></div>
            </div>
            <div class="cleaner">&nbsp;</div>
        </div>

        <div class="cleaner_with_height">&nbsp;</div>

        <div class="templatemo_product_box">
            <h1>Gardening <span>(by Famous Author)</span></h1>
            <img src="{{ asset('img/templatemo_image_03.jpg') }}" alt="image"/>
            <div class="product_info">
                <p>Ut fringilla enim sed turpis. Sed justo dolor, convallis at.</p>
                <h3>$65</h3>
                <div class="buy_now_button"><a href="#">Buy Now</a></div>
                <div class="detail_button"><a href="#">Detail</a></div>
            </div>
            <div class="cleaner">&nbsp;</div>
        </div>

        <div class="cleaner_with_width">&nbsp;</div>

        <div class="templatemo_product_box">
            <h1>Sushi Book <span>(by Japanese Name)</span></h1>
            <img src="{{ asset('img/templatemo_image_04.jpg') }}" alt="image"/>
            <div class="product_info">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                <h3>$45</h3>
                <div class="buy_now_button"><a href="#">Buy Now</a></div>
                <div class="detail_button"><a href="#">Detail</a></div>
            </div>
            <div class="cleaner">&nbsp;</div>
        </div>
@endsection
