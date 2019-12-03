@extends('layouts.default')

@section('title', $tacgia->name . ' tacgia')

@section('content')
    
    <br>
    <h1>{{ $tacgia->name }}</h1>
    <br>
    <h4> Email</h4>
    <p>{!! $tacgia->email !!}</p>
	<h4> Phone</h4>
	<p>{!! $tacgia->phone !!}</p>
	<h4> Address</h4>
	<p>{!! $tacgia->address !!}</p>
    <hr>
    <small>written on {{ $tacgia->created_at }}</small>
    <hr>

    @canany(['admin','staff'])
        <a class="btn btn-primary" href="{{ route('tacgias.edit', $tacgia->id) }}">Edit</a>
        <form action="{{ route('tacgias.destroy', $tacgia->id) }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcanany

@endsection
