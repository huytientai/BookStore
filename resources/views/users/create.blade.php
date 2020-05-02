@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
    <br>

    <h3>Create New User</h3>
    <br>
    <form action="{{ route('users.store') }}" method="post">
        @csrf

        {{--Email--}}
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label @error('email') text-danger @enderror">Email</label>
            <div class="col-sm-5">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?? $user->email ?? null }}">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        @include('users.form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

    <br>
    <br>
@endsection
