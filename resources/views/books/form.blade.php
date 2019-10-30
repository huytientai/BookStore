{{--book name--}}
<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label @error('name') text-danger @enderror">Name</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $book->name ?? null }}">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--describe--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('desc') text-danger @enderror">Describe</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('desc') is-invalid @enderror" id="article-ckeditor" name="desc" value="{{ old('desc') ?? $book->desc ?? null }}"></textarea>
        @error('desc')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

