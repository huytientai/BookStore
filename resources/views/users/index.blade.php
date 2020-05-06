@extends('layouts.admin')

@section('title', 'Users list')

@section('content')
    <br>
    <div class="container">
        @can('admin')
            <a href="{{ route('users.create') }}">
                <button class="btn btn-primary">Create User</button>
            </a>
        @endcan
        <br><br>
            @include('flash::message')

        <div class="container">
            <form action="{{ route('users.index') }}" class="form-group" method="get">
                @csrf
                <div class="row">
                    <div class="col-auto">
                        <input class="form-control mr-sm-0" type="search" placeholder="Email" name="email" value="{{ request('email') }}">
                    </div>
                    <div class="col-auto">
                        <input class="form-control mr-sm-0" type="search" placeholder="Name" name="name" value="{{ request('name') }}">
                    </div>
                    <div class="col-auto">
                        <input class="form-control mr-sm-0" type="search" placeholder="Address" name="address" value="{{ request('address') }}">
                    </div>
                    <div class="col-auto">
                        <input class="form-control mr-sm-0" type="search" placeholder="Phone" name="phone" value="{{ request('phone') }}">
                    </div>
                </div>

                <button class="btn btn-primary my-2 my-sm-10 container d-flex justify-content-center" type="submit">Search</button>
            </form>
        </div>

        <br>
        @if(count($users))
            <table class="table">
                <thead class="thead-light text-center">
                <tr>
                    <th>STT</th>
                    <th>Account</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th width="120">Role</th>
                    @can('admin')
                        <th width="230">Action</th>
                    @endcan
                </tr>
                </thead>

                @foreach($users as $key => $user)
                    <tr class="text-left">
                        <td>{{ $users->firstItem() + $key }}</td>
                        <td><a href="{{ route('users.show',$user->id) }}">{{ $user->email }}</a></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ \App\Models\User::$roles[$user->role] }}</td>

                        @can('admin')
                            <td>
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Update</a>
                                <button data-toggle="modal" onclick="deleteData({{ $user->id }})" data-target="#delete-modal" class="btn btn-xs btn-danger">Xóa</button>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </table>
            {!! $users->appends(request()->input())->links() !!}
        @else
            <p class="text-center">No Result.</p>
        @endif
    </div>

    <div id="delete-modal" class="modal fade text-danger" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="delete-form" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title text-center text-dark">DELETE CONFIRMATION</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        @method('delete')
                        <p class="text-center">Are you sure you want to delete this user?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">OK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        sidebar = document.getElementsByClassName('sidebar-wrapper').item(0).getElementsByClassName('nav').item(0);
        sidebar.getElementsByTagName('li').item(1).classList.add('active');

        function deleteData(id) {
            var id = id;
            var url = '{{ route("users.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#delete-form").attr('action', url);
        }

        function formSubmit() {
            $("#delete-form").submit();
        }
    </script>
@endsection
