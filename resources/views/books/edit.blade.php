@extends('exam1.default')

@section('title', 'edit book')

@section('content')
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <h1>Edit Book</h1>
            <br>
            <form action="{{ route('books.update', $book->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $book->id }}">

                @include('books.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">EDIT BOOK</button>
                </div>
            </form>
        </div>
    </div>
@endsection
