@extends('exam1.default')

@section('title', 'Add Publishing Company')

@section('content')
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <br>
            <h1>Add Publishing Company</h1>
            <form action="{{ route('nhaxuatbans.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('nhaxuatbans.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">ADD</button>
                </div>
            </form>
            <br>
        </div>
    </div>

@endsection
