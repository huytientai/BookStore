@extends('exam1.default')

@section('title', 'Update User')

@section('content')
    <br>
    <br>
    <div class="container">
        <br>
        <h3>Update</h3>
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">
            @include('users.form')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <br>
    <br>
@endsection
