@extends('Layouts.default')

@section('title', 'Book list')

@section('content')
    @include('flash::message')

    <h1>Books</h1>
    @if(count($books)>0)
        @foreach($books as $key => $book)
            <div class="card card-body bg-light">
                <div style="display:grid ;grid-template-columns: 30% 70%;grid-gap: 10px;">
                    <div style="width: 200px; height: 200px; ">
                        <a href="/books/{{$book->id}}">
                            @if($book->image)
                                <img src="/storage/book_images/{{ $book->image }}" style="width: 100%; height: 100%">
                            @else
                                <img style="width: 100%" src="/img/no_image.jpg">
                            @endif
                        </a>
                    </div>
                    <div class="" style="width: 90%; height: 200px">
                        <h3>{{ $books->firstItem() + $key }} . <a href="/books/{{$book->id}}"> {{ $book->name }}</a>
                        </h3>
                        <p> DESCRIBE: {!! substr($book->desc,0,180) . ' ...' !!}</p>
                        <small>update on {{ $book->created_at }}</small>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @endif
    <div style="width: 500px; height: 200px;">
        {!! $books->links() !!}
    </div>

@endsection
