@extends('layouts.default')

@section('title', 'Add Loaisach')

@section('content')
    <br>
    <h1>Add Loaisach</h1>
    <form action="{{ route('loaisachs.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('loaisachs.form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">ADD LOAISACH</button>
        </div>
    </form>

@endsection
