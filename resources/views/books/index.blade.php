@extends('layouts.default')

@section('title', 'Book list')

@section('content')
    @include('flash::message')

    <h1>Books</h1>
    @if(count($books)>0)
        @foreach($books as $key => $book)
            <div class="card card-body bg-light">
                <div class="row">
                    {{--                card card-body bg-light--}}
                    <div class="col-xs-4">xxxxxxxxxxxx</div>
                    <div class="col-xs-8">
                        <div>
                            <h3>{{ $books->firstItem() + $key }} . <a href="/books/{{$book->id}}"> {{ $book->name }}</a>
                            </h3>
                            <p> DESC: {!! $book->desc !!}</p>
                            <small>update on {{ $book->created_at }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @endif
    {!! $books->links() !!}

@endsection
