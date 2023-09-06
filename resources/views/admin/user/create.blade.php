@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data User</h5>
            </div>
            <div class="card-body">
                <form action="{{route('admin.user.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="nama" />
                    @if ($errors->has('name'))
                    <span class="red-text" style="color:red;">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="basic-default-company" placeholder="email" />
                    @if ($errors->has('email'))
                    <span class="red-text" style="color:red;">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Sandi</label>
                    <input type="password" name="password" class="form-control" id="basic-default-company" placeholder="sandi" />
                    @if ($errors->has('password'))
                    <span class="red-text" style="color:red;">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Peran</label>
                        <select class="form-select" name="role_id" id="exampleFormControlSelect1" aria-label="Default select example">
                          @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('role_id'))
                        <span class="red-text" style="color:red;">{{ $errors->first('role') }}</span>
                        @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Cabang</label>
                        <select class="form-select" name="branch_id" id="exampleFormControlSelect1" aria-label="Default select example">
                          @foreach($branchs as $branch)
                          <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->city_name}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('branch_id'))
                        <span class="red-text" style="color:red;">{{ $errors->first('branch') }}</span>
                        @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">No telp</label>
                    <input type="text" name="phone_number" class="form-control" placeholder="phone_number" />
                    @if ($errors->has('phone_number'))
                    <span class="red-text" style="color:red;">{{ $errors->first('phone_number') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection