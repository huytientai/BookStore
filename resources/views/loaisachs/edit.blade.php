@extends('exam1.default')

@section('title', 'edit loaisach')

@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <br>
            <h1>Edit Loaisach</h1>
            <form action="{{ route('loaisachs.update', $loaisach->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $loaisach->id }}">

                @include('loaisachs.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">EDIT LOAISACH</button>
                </div>
            </form>
        </div>
    </div>
@endsection
