@extends('layouts.admin')

@section('title', 'Create Discount Code')

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
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') ?? $discount->code ?? null }}" required>
                    @error('code')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="button" class="col-auto btn btn-sm btn-primary" onclick="generateRandomCode(10)">Random</button>
            </div>

            <div class="form-group row">
                <label for="discount" class="col-sm-2 col-form-label @error('discount') text-danger @enderror">discount($)</label>
                <div class="col-sm-5">
                    <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ old('discount') ?? $discount->discount ?? null }}" required>
                    @error('discount')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="start_time" class="col-sm-2 col-form-label @error('start_time') text-danger @enderror">start_time</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') ?? $discount->start_time ?? null }}">
                    @error('start_time')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="end_time" class="col-sm-2 col-form-label @error('end_time') text-danger @enderror">end_time</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') ?? $discount->end_time ?? null }}">
                    @error('end_time')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="price_condition" class="col-sm-2 col-form-label @error('price_condition') text-danger @enderror">Price condition($)</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control @error('price_condition') is-invalid @enderror" id="price_condition" name="price_condition" value="{{ old('price_condition') ?? $discount->price_condition ?? null }}">
                    @error('price_condition')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="num_condition" class="col-sm-2 col-form-label @error('num_condition') text-danger @enderror">Nums condition</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control @error('num_condition') is-invalid @enderror" id="num_condition" name="num_condition" value="{{ old('num_condition') ?? $discount->num_condition ?? null }}">
                    @error('num_condition')
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

        function generateRandomCode(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }

            document.getElementById('code').value = result;
        }
    </script>
@endsection
