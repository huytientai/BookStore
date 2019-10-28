@extends('layouts.default')

@section('title', 'Danh sách người dùng')

@section('content')
    <h1>Users</h1>
    @if(count($users)>1)
        @foreach($users as $user)
            <div class="card card-body bg-light">
                <h3>{{ $user->id }} . {{ $user->name }}</h3>
                <small>written on {{ $user->created_at }}</small>
            </div>
            <br>
        @endforeach
    @endif
@endsection
