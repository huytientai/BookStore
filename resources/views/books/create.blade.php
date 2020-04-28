@extends('exam1.default')

@section('title', 'Add Book')

@section('content')
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <h1>Add Book</h1>
            <br>
            <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('books.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">ADD BOOK</button>
                </div>
            </form>
        </div>
    </div>
@endsection
