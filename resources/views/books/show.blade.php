@extends('layouts.default')

@section('title', $book->name . ' book')

@section('content')
    <br>
    <h1>{{ $book->name }}</h1>
    <br>
    <h4> Describe</h4>
    <p>{!! $book->desc !!}</p>

    <hr>
    <small>written on {{ $book->created_at }}</small>
    <hr>

    <a class="btn btn-primary" href="{{ route('books.edit', $book->id) }}">Edit</a>
    <form action="{{ route('books.destroy', $book->id) }}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger" >Delete</button>
    </form>

@endsection
