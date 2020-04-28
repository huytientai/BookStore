@extends('layouts.admin')

@section('title', 'Chart')

@section('content')

    {!! $chart->container() !!}
    {!! $chart->script() !!}
    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(0).classList.add('active');
    </script>
@endsection
