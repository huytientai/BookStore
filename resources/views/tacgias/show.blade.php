@extends('layouts.default')

@section('title', $tacgia->name . ' tacgia')

@section('content')
    <div class="col-md-8 col-sm-8">
        <br>
        @if($tacgia->image)
            <img style="width: 100%" src="/storage/book_images/{{ $book->image }}">
        @else
            <img style="width: 70%" src="/img/no_image.jpg">
        @endif
    </div>
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
	<h4> Describe</h4>
    <p>{!! $tacgia->desc !!}</p>
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
