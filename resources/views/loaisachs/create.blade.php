@extends('exam1.default')

@section('title', 'Add Loaisach')

@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <br>
            <h1>Add Loaisach</h1>
            <form action="{{ route('loaisachs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('loaisachs.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">ADD LOAISACH</button>
                </div>
            </form>
        </div>
    </div>

@endsection
