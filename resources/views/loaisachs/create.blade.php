@extends('exam1.default')

@section('title', 'Add Category')

@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <br>
            <h1>Add Category</h1>
            <form action="{{ route('loaisachs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('loaisachs.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">ADD</button>
                </div>
            </form>
        </div>
    </div>

@endsection
