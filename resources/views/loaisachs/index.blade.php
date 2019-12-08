@extends('layouts.default')

@section('title', 'Loaisach list')

@section('content')
    @include('flash::message')

    <h1>Loaisachs</h1>
    @if(count($loaisachs)>0)
        @foreach($loaisachs as $key => $loaisach)
            <div class="card card-body bg-light">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a href="/loaisachs/{{$loaisach->id}}">
                            @if($loaisach->image)
                                <img style="width: 100%" src="/storage/loaisach_images/{{ $loaisach->image }}">
                            @else
                                <img style="width: 100%" src="/img/no_image.jpg">
                            @endif
                        </a>
                    </div>

                    <div class="col-md-8">
                        <div>
                            <h3>{{ $loaisachs->firstItem() + $key }} . <a href="/loaisachs/{{$loaisach->id}}"> {{ $loaisach->name }}</a>
                            </h3>
                            <p> DESCRIBE: {!! substr($loaisach->desc,0,100) . '...' !!}</p>
                            <small>update on {{ $loaisach->created_at }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @endif
    {!! $loaisachs->links() !!}


@endsection
