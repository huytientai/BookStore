@extends('layouts.admin')

@section('title', 'Needed Imports List')

@section('content')
    <div class="container">
        <h3>Warehouse (<50)</h3>
        @if(count($needed1))
            <table class="table">
                <thead class="thead-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Book</th>
                    <th>Nums</th>
                    <th>Virtual Nums</th>
                </tr>
                </thead>

                @foreach($needed1 as $key => $book)
                    <tr class="text-left">
                        <td class="text-center">
                            <a href="{{ route('books.show',$book->id) }}">{{ $book->id }}</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('books.show',$book->id) }}">{{ $book->name }}</a></td>
                        <td class="text-center">
                            {{ $book->soluong }}</td>
                        <td class="text-center">{{ $book->virtual_nums }}</td>
                    </tr>
                @endforeach
            </table>
        @endif


        <h3>Virtual Nums (<20)</h3>
        @if(count($needed2))
            <table class="table">
                <thead class="thead-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Book</th>
                    <th>Nums</th>
                    <th>Virtual Nums</th>
                </tr>
                </thead>

                @foreach($needed2 as $key => $book)
                    <tr class="text-left">
                        <td class="text-center">
                            <a href="{{ route('books.show',$book->id) }}">{{ $book->id }}</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('books.show',$book->id) }}">{{ $book->name }}</a></td>
                        <td class="text-center">
                            {{ $book->soluong }}</td>
                        <td class="text-center">{{ $book->virtual_nums }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

    </div>

    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(6).classList.add('active');
    </script>
@endsection
