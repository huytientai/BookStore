@extends('exam1.default')

@section('title', $nhaxuatban->name . ' nhaxuatban')

@section('content')
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <br>
            @include('flash::message')

            <div class="col-md-8 col-sm-8">
                <br>
                @if($nhaxuatban->image)
                    <img style="width: 100%" src="/storage/nhaxuatban_images/{{ $nhaxuatban->image }}">
                @else
                    <img style="width: 70%" src="/img/no_image.jpg">
                @endif
            </div>
            <br>
            <h1>{{ $nhaxuatban->name }}</h1>
            <br>

            <h4> Phone</h4>
            <p>{!! $nhaxuatban->phone !!}</p>
            <h4> Address</h4>
            <p>{!! $nhaxuatban->address !!}</p>
            <hr>

            <small>written on {{ $nhaxuatban->created_at }}</small>
            <hr>

            @canany(['admin','staff'])
                <a class="btn btn-primary" href="{{ route('nhaxuatbans.edit', $nhaxuatban->id) }}">Edit</a>
                <form action="{{ route('nhaxuatbans.destroy', $nhaxuatban->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endcanany
            <br><br>

            <h1>Books</h1>
            @if(count($books)>0)
                @foreach($books as $key => $book)
                    <div class="card card-body bg-light">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <a href="/books/{{$book->id}}">
                                    @if($book->image)
                                        <img style="width: 100%" src="/storage/book_images/{{ $book->image }}">
                                    @else
                                        <img style="width: 100%" src="/img/books/default_book.jpg">
                                    @endif
                                </a>
                            </div>

                            <div class="col-md-8">
                                <div>
                                    <h3>{{ $books->firstItem() + $key }} .
                                        <a href="/books/{{$book->id}}"> {{ $book->name }}</a>
                                    </h3>
                                    <p> DESCRIBE: {!! substr($book->desc,0,100) . '...' !!}</p>
                                    <small>update on {{ $book->created_at }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            @endif
            {!! $books->links() !!}
            <br>
        </div>
    </div>

@endsection
