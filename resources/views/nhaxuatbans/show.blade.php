@extends('layouts.default')

@section('title', $nhaxuatban->name . ' nhaxuatban')

@section('content')
    <div class="col-md-8 col-sm-8">
        <br>
        @if($nhaxuatban->image)
            <img style="width: 100%" src="/storage/nhaxuatban_images/{{ $nhaxuatban->image }}">
        @else
            <img style="width: 70%" src="/img/no_image.jpg">
        @endif
    </div>
    <br>
    <h1>{{ $nhaxuatban->name }}</h1>
    <br>
    
	<h4> Phone</h4>
	<p>{!! $nhaxuatban->phone !!}</p>
	<h4> Address</h4>
	<p>{!! $nhaxuatban->address !!}</p>
    <hr>
	
    <small>written on {{ $nhaxuatban->created_at }}</small>
    <hr>

    @canany(['admin','staff'])
        <a class="btn btn-primary" href="{{ route('nhaxuatbans.edit', $nhaxuatban->id) }}">Edit</a>
        <form action="{{ route('nhaxuatbans.destroy', $nhaxuatban->id) }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcanany

@endsection
