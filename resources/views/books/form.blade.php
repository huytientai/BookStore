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

{{--Loai sach--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('loaisach_id') text-danger @enderror">Category</label>
    <div class="col-sm-5">
        <select class="browser-default custom-select mr-sm-0" name="loaisach_id">
            @foreach(\App\Models\Loaisach::pluck('name', 'id')->toArray() as $key => $value)
                <option value="{{ $key }}" {{ ((old('loaisach_id') ?? $book->loaisach_id ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
        @error('loaisach_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--Tac Gia--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Author</label>
    <div class="col-sm-5">
        <select class="browser-default custom-select mr-sm-0" name="tacgia_id">
            @foreach(\App\Models\tacgia::pluck('name', 'id')->toArray() as $key => $value)
                <option value="{{ $key }}" {{ ((old('tacgia_id') ?? $book->tacgia_id ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>

{{--Nha xuat ban--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Publishing Comp</label>
    <div class="col-sm-5">
        <select class="browser-default custom-select mr-sm-0" name="nhaxuatban_id">
            @foreach(\App\Models\Nhaxuatban::pluck('name', 'id')->toArray() as $key => $value)
                <option value="{{ $key }}" {{ ((old('nhaxuatban_id') ?? $book->nhaxuatban_id ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>

{{--describe--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('desc') text-danger @enderror">Describe</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('desc') is-invalid @enderror" id="article-ckeditor" name="desc">{{ old('desc') ?? $book->desc ?? null }}</textarea>
        @error('desc')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--image--}}
<div class="form-group row">
    <label for="image" class="col-md-2 col-form-label">Book Image</label>
    <div class="col-md-5">
        <input id="image" type="file" name="image">
        <div style="width: 200px;padding-top: 10px">
            @if(isset($book->image))
                <img src="/storage/book_images/{{ $book->image }}" id="display_image" alt="Not Found"/>
            @else
                <img src="" id="display_image" width="200px" alt="No image"/>
            @endif
        </div>
    </div>
</div>

{{-- price --}}
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label @error('price') text-danger @enderror">price($)</label>
    <div class="col-sm-5">
        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') ?? $book->price ?? null }}">
        @error('price')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--book ngayxb--}}
<div class="form-group row">
    <label for="ngayxb" class="col-sm-2 col-form-label @error('ngayxb') text-danger @enderror">Publish Date</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('ngayxb') is-invalid @enderror" id="ngayxb" name="ngayxb" value="{{ old('ngayxb') ?? $book->ngayxb ?? null }}">
        @error('ngayxb')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--book size--}}
<div class="form-group row">
    <label for="size" class="col-sm-2 col-form-label @error('size') text-danger @enderror">Size</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="size" value="{{ old('size') ?? $book->size ?? null }}">
        @error('size')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--book loaibia--}}
<div class="form-group row">
    <label for="loaibia" class="col-sm-2 col-form-label @error('loaibia') text-danger @enderror">Paper Cover</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('loaibia') is-invalid @enderror" id="loaibia" name="loaibia" value="{{ old('loaibia') ?? $book->loaibia ?? null }}">
        @error('loaibia')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--book sotrang--}}
<div class="form-group row">
    <label for="sotrang" class="col-sm-2 col-form-label @error('sotrang') text-danger @enderror">Number of Pages</label>
    <div class="col-sm-5">
        <input type="number" class="form-control @error('sotrang') is-invalid @enderror" id="sotrang" name="sotrang" value="{{ old('sotrang') ?? $book->sotrang ?? null }}">
        @error('sotrang')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--table of contents--}}
<div class="form-group row">
    <label for="contents" class="col-md-2 col-form-label">Table of contents</label>
    <div class="col-md-5">
        <input id="contents" type="file" name="contents[]" multiple>
        <div style="padding-top: 10px" class="row contents">
            @if(isset($contents))
                @foreach($contents as $content)
                    <img style="width: 200px" src="/storage/table_of_contents/{{ $content->picture }}" class="display_contents" alt="Not Found"/>
                @endforeach
            @else
                <img src="" class="display_contents" width="200px" alt="No image"/>
            @endif
        </div>
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

    $("#contents").change(function () {
        if (this.files && this.files[0]) {
            $(".display_contents").remove();

            var filesAmount = this.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img style="width: 200px" class="display_contents" alt="Not Found">')).attr('src', event.target.result).appendTo('div.contents');
                }

                reader.readAsDataURL(this.files[i]);
            }
        }
    });

</script>
