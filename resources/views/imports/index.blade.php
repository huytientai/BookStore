@extends('layouts.admin')

@section('title', 'All Imports')

@section('content')
    <br><br>
    @include('flash::message')

    <div class="container">
        <form action="{{ route('imports.index') }}" class="form-group" method="get">
            @csrf
            <div class="row">
                <div class="col-auto">
                    <input class="form-control mr-sm-0" type="search" placeholder="Name" name="name" value="{{ request('name') }}">
                </div>
                <div class="col-auto">
                    <input class="form-control mr-sm-0" type="search" placeholder="Book" name="book" value="{{ request('book') }}">
                </div>
                <div class="col-auto">
                    <input class="form-control mr-sm-0" type="search" placeholder="Quantity" name="quantity" value="{{ request('quantity') }}">
                </div>
                <div class="col-auto">
                    <input class="form-control mr-sm-0" type="search" placeholder="From" name="from" value="{{ request('from') }}">
                </div>
                <div class="col-auto">
                    <input class="form-control mr-sm-0" type="search" placeholder="Accepted By" name="accepted" value="{{ request('accepted') }}">
                </div>
            </div>
            <div class="col-auto">
                <input class="form-control mr-sm-0 text-center" type="search" placeholder="Note" name="note" value="{{ request('note') }}">
            </div>

            <button class="btn btn-primary my-2 my-sm-10 container d-flex justify-content-center" type="submit">Search</button>
        </form>
    </div>

    <br>
    @if(count($imports))
        <table class="table">
            <thead class="thead-light text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Book</th>
                <th>Quantity</th>
                <th>From</th>
                <th>Note</th>
                <th>Time</th>
                <th>Accepted</th>
            </tr>
            </thead>

            @foreach($imports as $key => $import)
                <tr class="text-left">
                    <td class="text-center">
                        <a href="{{ route('imports.show',$import->id) }}">{{ $imports->firstItem() + $key }}</a></td>
                    <td class="text-center">
                        <a href="{{ route('users.show',$import->user->id) }}">{{ $import->user->name }}</a></td>
                    <td class="text-center">
                        <a href="{{ route('books.show',$import->book->id) }}">{{ $import->book->name }}</a></td>
                    <td class="text-center">{{ $import->quantity }}</td>
                    <td class="text-center">{{ $import->from }}</td>
                    @if(strlen($import->note)<30)
                        <td class="text-center">{!! $import->note !!}</td>
                    @else
                        <td class="text-center">{!! substr($import->note,0,30) . ' ...' !!}</td>
                    @endif
                    <td class="text-center">{{ $import->updated_at }}</td>
                    <td class="text-center">
                        @if($import->status)
                            <a href="{{ route('users.show',$import->accepted->id) }}">{{ $import->accepted->name }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $imports->appends(request()->input())->links() !!}
    @else
        <p class="text-center">No result.</p>
    @endif

    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(2).classList.add('active');
    </script>
@endsection
