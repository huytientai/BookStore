@extends('exam1.default')

@section('title', 'Update User')

@section('content')
    <br>
    <br>
    <div class="container">
        <br>
        <h3>Update</h3>
        <br>
        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">

            {{--Avatar--}}
            <div class="form-group row">
                <label for="avatar" class="col-md-2 col-form-label">Avatar</label>
                <div class="col-md-5">
                    <input id="avatar" type="file" name="avatar">
                    <div style="width: 200px;padding-top: 10px">
                        @if(isset($user->avatar))
                            <img src="/storage/avatar/{{ $user->avatar }}" id="display_avatar" alt="Not Found"/>
                        @else
                            <img src="{{ asset('storage/avatar/default.jpg') }}" id="display_avatar" width="200px" alt="No image"/>
                        @endif
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#display_avatar').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#avatar").change(function () {
                    readURL(this);
                });

            </script>

            @include('users.form')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <br>
    <br>
@endsection
