@extends('layouts.admin')

@section('title', 'Discount Code')

@section('content')
    <br><br>
    @include('flash::message')

    <div class="container">
        <h3>Discount #{{ $discount->id }}</h3>
        <br>

        <div>Code: {{ $discount->code }}</div>
        <div>Discount: {{ $discount->discount }}</div>
        <div>Price Condition: {{ $discount->price_condition }}</div>
        <div>Num Condition: {{ $discount->num_condition }}</div>
        <div>Active: {{ $discount->start_time }} -> {{ $discount->end_time }}</div>

        <br>
        <br>
        <div>Creator:
            <a href="{{ route('users.show', $discount->creator_id) }}">{{ $discount->creator->name }}</a>
        </div>
        <div>Create At: {{ $discount->created_at }}</div>
        <br>
        <br>
    </div>

    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(5).classList.add('active'); // config
    </script>
@endsection
