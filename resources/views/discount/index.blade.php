@extends('layouts.admin')

@section('title', 'Discount discount List')

@section('content')
    <br><br>
    @include('flash::message')

    <div class="container">
        <h3>Discount discount</h3>

        <a class="btn btn-primary" style="background-color: #0b75c9" href="{{ route('discount.create') }}">Create</a>

        <br><br>
        <small>Note: code effect forever when end_time = null</small>

        @if(count($discounts))
            <table class="table">
                <thead class="thead-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Price condition</th>
                    <th>Num condition</th>
                    <th>Start</th>
                    <th>End</th>
                    @canany(['admin', 'staff'])
                        <th style="width: 200px">Action</th>
                    @endcan
                </tr>
                </thead>

                @foreach($discounts as $key => $discount)
                    <tr class="text-center" @if($discount->deleted_at) style="background-color: #9c9692" @endif>
                        <td>
                            <a href="{{ route('discount.show', $discount->id) }}">{{ $discounts->firstItem() + $key }}</a>
                        </td>
                        <td style="color: #0b75c9">{{ $discount->code }}</td>
                        <td>{{ $discount->discount }}</td>
                        <td>{{ $discount->price_condition }}</td>
                        <td>{{ $discount->num_condition }}</td>
                        <td>{{ $discount->start_time }}</td>
                        <td>{{ $discount->end_time }}</td>

                        @canany(['admin', 'staff'])
                            @if($discount->deleted_at)
                                <td class="row"></td>
                            @else
                                <td class="row">
                                    <a class="btn btn-primary" href="{{ route('discount.edit', $discount->id) }}">Edit</a>
                                    <form action="{{ route('discount.destroy', $discount->id) }}" method="post" style="margin-bottom: 0px">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            @endif
                        @endcan
                    </tr>
                @endforeach
            </table>
            {!! $discounts->appends(request()->input())->links() !!}
        @else
            <p class="text-center">No Result.</p>
        @endif
    </div>
    <script>
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(5).classList.add('active'); // config
    </script>
@endsection
