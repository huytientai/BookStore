@extends('layouts.default')

@section('title','app')

@section('content')
    <div id="app">
        <h3>ChatRoom</h3>
        <chat-message></chat-message>
        <chat-log></chat-log>
        <chat-composer></chat-composer>

    </div>
@endsection
