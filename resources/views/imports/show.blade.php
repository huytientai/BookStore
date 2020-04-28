@extends('layouts.admin')

@section('title', 'Import #' . $import->id)

@section('content')
    <br><br>
    @include('flash::message')
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <h3>Import #{{ $import->id }}</h3>
            <br>

            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                            @if($import->book->image)
                                <a><img style="width: 100%" src="/storage/book_images/{{ $import->book->image }}"></a>
                            @else
                                <a><img style="width: 100%" src="/img/books/default_book.jpg"></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm">
                        <p><a href="{{ route('books.show',$import->book->id) }}">{{ $import->book->name }}</a></p>
                        <div style="padding-left: 15px">
                            <p>Request by:
                                <a href="{{ route('users.show',$import->user->id) }}">{{ $import->user->name }}</a></p>
                            <p>quantity: {{ $import->quantity }}</p>
                            <p>from: {{ $import->from }}</p>
                            <div class="row" style="padding-left: 15px">
                                <p>status: </p>
                                @if($import->status)
                                    <p>done</p>
                                @else
                                    <p>waiting</p>
                                @endif
                            </div>

                            @if($import->status)
                                <p>Accepted by:
                                    <a href="{{ route('users.show',$import->id) }}">{{ $import->accepted->name }}</a>
                                </p>
                                <form action="{{ route('imports.revert',$import->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Revert</button>
                                </form>
                            @else
                                <div class="row">
                                    <form action="{{ route('imports.accept',$import->id) }}" method="get">
                                        <button class="btn btn-primary" type="submit">Accept</button>
                                    </form>
                                    <form action="{{ route('imports.denies',$import->id) }}" method="get">
                                        <button class="btn btn-danger">Denies</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div style="padding-left: 15px">
                    <p>Note:</p>
                    <p>&nbsp;{{ $import->note }}</p>
                </div>
            </div>
        </div>

    </div>@endsection
