@extends('layouts.default')

@section('title', 'Add Tacgia')

@section('content')
    <br>
    <h1>Add Tacgia</h1>
    <form action="{{ route('tacgias.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('tacgias.form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">ADD TACGIA</button>
        </div>
    </form>

@endsection
