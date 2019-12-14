{{--name--}}
<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label @error('name') text-danger @enderror">Name</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $nhaxuatban->name ?? null }}">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
{{--address--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('address') text-danger @enderror">Address</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('address') is-invalid @enderror" id="article-ckeditor" name="address">{{ old('address') ?? $nhaxuatban->address ?? null }}</textarea>
        @error('address')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
{{--phone--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('phone') text-danger @enderror">Phone</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('phone') is-invalid @enderror" id="article-ckeditor" name="phone">{{ old('phone') ?? $nhaxuatban->phone ?? null }}</textarea>
        @error('phone')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--image--}}
<div class="form-group row">
    <label for="image" class="col-md-2 col-form-label">Image</label>
    <div class="col-md-5">
        <input id="image" type="file" name="image">
    </div>
</div>


