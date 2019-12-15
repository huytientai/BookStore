@extends('exam1.default')

@section('title', 'Book type list')

@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <br><br><br><br>
	    @canany(['admin','staff'])
                                <a class="btn btn-primary" href="{{ route('loaisachs.create') }}">Create Loai sach</a>
                                <br><br>
                            @endcanany
            @include('flash::message')

            <h1>Loaisachs</h1>
            @if(count($loaisachs)>0)
                @foreach($loaisachs as $key => $loaisach)
                    <div class="card card-body bg-light">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <a href="/loaisachs/{{$loaisach->id}}"></a>
                            </div>

                            <div class="col-md-8">
                                <div>
                                    <h3>{{ $loaisachs->firstItem() + $key }} .
                                        <a href="/loaisachs/{{$loaisach->id}}"> {{ $loaisach->name }}</a>
                                    </h3>
                                    <small>update on {{ $loaisach->created_at }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            @endif
            {!! $loaisachs->links() !!}

            <br><br><br><br>
        </div>
    </div>
@endsection
