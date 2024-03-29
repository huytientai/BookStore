@extends('exam1.default')

@section('title', 'edit Publishing Company')

@section('content')
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <br>
            <h1>Edit Publishing Company</h1>
            <form action="{{ route('nhaxuatbans.update', $nhaxuatban->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $nhaxuatban->id }}">

                @include('nhaxuatbans.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">EDIT</button>
                </div>
            </form>
            <br>
        </div>
    </div>

@endsection
