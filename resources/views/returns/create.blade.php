@extends('exam1.default')

@section('title', 'Create returns ship Info')

@section('content')
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">

            <h1>Order#{{ $order_id }} Returns ship Info</h1>
            <br>
            <form action="{{ route('returns.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{--order_id--}}
                <input type="hidden" name="order_id" value="{{ $order_id }}">

                {{--ship_merchant--}}
                <div class="form-group row">
                    <label for="ship_merchant" class="col-sm-2 col-form-label @error('ship_merchant') text-danger @enderror">Ship Merchant(*)</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('ship_merchant') is-invalid @enderror" id="ship_merchant" name="ship_merchant" value="{{ old('ship_merchant') ?? $returns->ship_merchant ?? null }}" required>
                        @error('ship_merchant')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{--ship_id--}}
                <div class="form-group row">
                    <label for="ship_id" class="col-sm-2 col-form-label @error('ship_id') text-danger @enderror">Ship ID(*)</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('ship_id') is-invalid @enderror" id="ship_id" name="ship_id" value="{{ old('ship_id') ?? $returns->ship_id ?? null }}" required>
                        @error('ship_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{--image--}}
                <div class="form-group row">
                    <label for="image" class="col-md-2 col-form-label">Image</label>
                    <div class="col-md-5">
                        <input id="image" type="file" name="image">
                        <div style="width: 200px;padding-top: 10px">
                            @if(isset($returns->image))
                                <img src="/storage/returns_images/{{ $returns->image }}" id="display_image" alt="Not Found"/>
                            @else
                                <img src="" id="display_image" width="200px" alt="No image"/>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send Ship Info</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#display_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function () {
            readURL(this);
        });
    </script>
@endsection
