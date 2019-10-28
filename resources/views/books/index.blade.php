@extends('layouts.default')

@section('title', 'Book list')

@section('content')
    <h1>Users</h1>
    @if(count($books)>1)
        @foreach($books as $book)
            <div class="card card-body bg-light">
                <h3>{{ $book->id }} . <a href="/books/{{$book->id}}"> {{ $book->name }}</a></h3>
                <p> DESC: {{ $book->desc }}</p>
                <small>written on {{ $book->created_at }}</small>
            </div>
            <br>
        @endforeach
    @endif
@endsection
