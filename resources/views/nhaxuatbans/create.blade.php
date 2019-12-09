@extends('layouts.default')

@section('title', 'Add Nhaxuatban')

@section('content')
    <br>
    <h1>Add Nhaxuatban</h1>
    <form action="{{ route('nhaxuatbans.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('nhaxuatbans.form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">ADD NHAXUATBAN</button>
        </div>
    </form>

@endsection
