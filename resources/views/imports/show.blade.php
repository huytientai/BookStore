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
                                <p>Done by:
                                    <a href="{{ route('users.show',$import->warehouseman->id) }}">{{ $import->warehouseman->name }}</a>
                                </p>
                                @can('admin')
                                    <form action="{{ route('imports.revert',$import->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Revert</button>
                                    </form>
                                @endcan
                            @else
                                <div class="row">
                                    @can('warehouseman')
                                        <form action="{{ route('imports.done',$import->id) }}" method="get">
                                            <button class="btn btn-primary" type="submit">Done</button>
                                        </form>
                                    @endcan

                                    @if(Auth::user()->role == \App\Models\User::ADMIN || (Auth::user()->role == \App\Models\User::STAFF && Auth::id() == $import->user_id))
                                        <form action="{{ route('imports.destroy',$import->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    @endif
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
    </div>

    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(3).classList.add('active');
    </script>
@endsection
