@extends('layouts.admin')

@section('title', 'Discount discount List')

@section('content')
    <br><br>
    @include('flash::message')

    <div class="container">
        <h3>Create New discount</h3>
        <br>
        <form action="{{ route('discount.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label @error('code') text-danger @enderror">code</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') ?? $discount->code ?? null }}">
                    @error('code')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="discount" class="col-sm-2 col-form-label @error('discount') text-danger @enderror">discount</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ old('discount') ?? $discount->discount ?? null }}">
                    @error('discount')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="start_time" class="col-sm-2 col-form-label @error('start_time') text-danger @enderror">start_time</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') ?? $discount->start_time ?? null }}">
                    @error('start_time')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="end_time" class="col-sm-2 col-form-label @error('end_time') text-danger @enderror">end_time</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') ?? $discount->end_time ?? null }}">
                    @error('end_time')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="condition" class="col-sm-2 col-form-label @error('condition') text-danger @enderror">condition</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control @error('condition') is-invalid @enderror" id="condition" name="condition" value="{{ old('condition') ?? $discount->condition ?? null }}">
                    @error('condition')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>

        <br>
        <br>
    </div>

    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(5).classList.add('active'); // config
    </script>
@endsection
