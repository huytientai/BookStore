@extends('layouts.default')

@section('title', $book->name . ' book')

@section('content')
    <h1>{{ $book->name }}</h1>
    <br>
    <h4> Describe</h4>
    <p>{{ $book->desc }}</p>
    <br>
    <small>written on {{ $book->created_at }}</small>
@endsection
