{{--name--}}
<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label @error('name') text-danger @enderror">Name</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $tacgia->name ?? null }}">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--email--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('email') text-danger @enderror">Email</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('email') is-invalid @enderror" id="article-ckeditor" name="email">{{ old('email') ?? $tacgia->email ?? null }}</textarea>
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--phone--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('phone') text-danger @enderror">Phone</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('phone') is-invalid @enderror" id="article-ckeditor" name="phone">{{ old('phone') ?? $tacgia->phone ?? null }}</textarea>
        @error('phone')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--address--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('address') text-danger @enderror">Address</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('address') is-invalid @enderror" id="article-ckeditor" name="address">{{ old('address') ?? $tacgia->address ?? null }}</textarea>
        @error('address')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


