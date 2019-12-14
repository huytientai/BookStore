@extends('exam1.default')

@section('title', 'edit tacgia')

@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <br>
            <h1>Edit Tacgia</h1>
            <form action="{{ route('tacgias.update', $tacgia->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $tacgia->id }}">

                @include('tacgias.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">EDIT TACGIA</button>
                </div>
            </form>
            <br>
        </div>
    </div>
@endsection
