{{--Mật khẩu--}}
<div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label @error('password') text-danger @enderror">Password</label>
    <div class="col-sm-5">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--Mật khẩu xác nhận--}}
<div class="form-group row">
    <label for="password-confirmation" class="col-sm-2 col-form-label @error('password_confirmation') text-danger @enderror">Password Confirmation</label>
    <div class="col-sm-5">
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirmation" name="password_confirmation">
        @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--Tên--}}
<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label @error('name') text-danger @enderror">Name</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $user->name ?? null }}">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--Địa chỉ--}}
<div class="form-group row">
    <label for="address" class="col-sm-2 col-form-label @error('address') text-danger @enderror">Address</label>
    <div class="col-sm-5">
        <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') ?? $user->address ?? null }}">
        @error('address')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="address1" class="col-sm-2 col-form-label @error('address1') text-danger @enderror">Address 1</label>
    <div class="col-sm-5">
        <input type="text" class="form-control  @error('address1') is-invalid @enderror" id="address1" name="address1" value="{{ old('address1') ?? $user->address1 ?? null }}">
        @error('address1')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="address2" class="col-sm-2 col-form-label @error('address2') text-danger @enderror">Address 2</label>
    <div class="col-sm-5">
        <input type="text" class="form-control  @error('address2') is-invalid @enderror" id="address2" name="address2" value="{{ old('address2') ?? $user->address2 ?? null }}">
        @error('address2')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="address3" class="col-sm-2 col-form-label @error('address3') text-danger @enderror">Address 3</label>
    <div class="col-sm-5">
        <input type="text" class="form-control  @error('address3') is-invalid @enderror" id="address3" name="address3" value="{{ old('address3') ?? $user->address3 ?? null }}">
        @error('address3')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


{{--Số điện thoại--}}
<div class="form-group row">
    <label for="phone" class="col-sm-2 col-form-label @error('phone') text-danger @enderror">Phone</label>
    <div class="col-sm-5">
        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') ?? $user->phone ?? null }}">
        @error('phone')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

{{--role--}}
@can('admin')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Role</label>
        <div class="col-sm-5">
            <select class="browser-default custom-select" name="role">
                @php
                    $roles = \App\Models\User::$roles;
                @endphp

                @foreach($roles as $key => $value)
                    <option value="{{ $key }}" {{ ((old('role') ?? $user->role ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endcan

