@extends('exam1.default')

@section('title', 'Add Tacgia')

@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <br>
            <h1>Add Author</h1>
            <form action="{{ route('tacgias.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('tacgias.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">ADD</button>
                </div>
            </form>
            <br>
        </div>
    </div>

@endsection
