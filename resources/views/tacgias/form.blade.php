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

{{--born--}}
<div class="form-group row">
    <label for="born" class="col-sm-2 col-form-label @error('born') text-danger @enderror">Born</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('born') is-invalid @enderror" id="born" name="born" value="{{ old('born') ?? $tacgia->born ?? null }}">
        @error('born')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--nationality--}}
<div class="form-group row">
    <label for="nationality" class="col-sm-2 col-form-label @error('nationality') text-danger @enderror">Nationality</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('nationality') is-invalid @enderror" id="nationality" name="nationality" value="{{ old('nationality') ?? $tacgia->nationality ?? null }}">
        @error('nationality')
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

{{--describe--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('desc') text-danger @enderror">Tieu su</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('desc') is-invalid @enderror" id="article-ckeditor" name="desc">{{ old('desc') ?? $tacgia->desc ?? null }}</textarea>
        @error('desc')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--image--}}
<div class="form-group row">
    <label for="image" class="col-md-2 col-form-label">Image</label>
    <div class="col-md-5">
        <input id="image" type="file" name="image">
{{--        @if ($tacgia->image)--}}
{{--            <code>{{ $tacgia->image }}</code>--}}
{{--        @endif--}}
    </div>
</div>

