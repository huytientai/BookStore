@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
    <br>
    <br>

    <h3>Create New User</h3>
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        @include('users.form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

    <br>
    <br>
@endsection
