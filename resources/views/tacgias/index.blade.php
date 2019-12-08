@extends('layouts.default')

@section('title', 'Tacgia list')

@section('content')
    @include('flash::message')

    <h1>Tác giả</h1>
    @if(count($tacgias)>0)
        @foreach($tacgias as $key => $tacgia)
            <div class="card card-body bg-light">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a href="/tacgias/{{$tacgia->id}}">
                            @if($tacgia->image)
                                <img style="width: 100%" src="/storage/tacgia_images/{{ $tacgia->image }}">
                            @else
                                <img style="width: 100%" src="/img/no_image.jpg">
                            @endif
                        </a>
                    </div>

                    <div class="col-md-8">
                        <div>
                            <h3>{{ $tacgias->firstItem() + $key }} . <a href="/tacgias/{{$tacgia->id}}"> {{ $tacgia->name }}</a>
                            </h3>
                            <p> Email: {!! substr($tacgia->email,0,100) . '...' !!}</p>
							<p> Phone: {!! substr($tacgia->phone,0,100) . '...' !!}</p>
							<p> Address: {!! substr($tacgia->address,0,100) . '...' !!}</p>
							<p> Describe: {!! substr($tacgia->desc,0,100) . '...' !!}</p>
                            <small>update on {{ $tacgia->created_at }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @endif
    {!! $tacgias->links() !!}


@endsection