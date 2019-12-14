@extends('exam1.default')

@section('title', $tacgia->name . ' tacgia')

@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            @include('flash::message')
            <div class="col-md-8 col-sm-8">
                <br>
                @if($tacgia->image)
                    <img style="width: 100%" src="/storage/tacgia_images/{{ $tacgia->image }}">
                @else
                    <img style="width: 70%" src="/img/no_image.jpg">
                @endif
            </div>
            <br>
            <h1>{{ $tacgia->name }}</h1>
            <br>
            <h4> Born</h4>
            <p>{!! $tacgia->born !!}</p>
            <h4> Nationality</h4>
            <p>{!! $tacgia->nationality !!}</p>
            <h4> Email</h4>
            <p>{!! $tacgia->email !!}</p>
            <h4> Phone</h4>
            <p>{!! $tacgia->phone !!}</p>
            <h4> Address</h4>
            <p>{!! $tacgia->address !!}</p>
            <hr>
            <h4> Tieu Su</h4>
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

            <br><br><br><br>
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
                                        <img style="width: 100%" src="/img/no_image.jpg">
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
        </div>
    </div>
@endsection
