@extends('exam1.default')

@section('title', 'Nhaxuatban list')

@section('content')
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <br>
            @canany(['admin','staff'])
                <a class="btn btn-primary" href="{{ route('nhaxuatbans.create') }}">Create Nha xuat ban</a>
                <br><br>
            @endcanany

            @include('flash::message')

            <h1>Nhà xuất bản</h1>
            @if(count($nhaxuatbans)>0)
                @foreach($nhaxuatbans as $key => $nhaxuatban)
                    <div class="card card-body bg-light">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <a href="/nhaxuatbans/{{$nhaxuatban->id}}">
                                    @if($nhaxuatban->image)
                                        <img style="width: 100%" src="/storage/nhaxuatban_images/{{ $nhaxuatban->image }}">
                                    @else
                                        <img style="width: 100%" src="/img/no_image.jpg">
                                    @endif
                                </a>
                            </div>

                            <div class="col-md-8">
                                <div>
                                    <h3>{{ $nhaxuatbans->firstItem() + $key }} .
                                        <a href="/nhaxuatbans/{{$nhaxuatban->id}}"> {{ $nhaxuatban->name }}</a>
                                    </h3>
                                    <p> Phone: {!! $nhaxuatban->phone !!}</p>
                                    <p> Address: {!! substr($nhaxuatban->address,0,100) !!}</p>
                                    <small>update on {{ $nhaxuatban->created_at }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            @endif
            {!! $nhaxuatbans->links() !!}
            <br>
        </div>
    </div>

@endsection
