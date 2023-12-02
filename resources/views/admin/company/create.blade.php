@extends('admin.layouts.index')
@section('content')
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah</h5>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-warning alert-dismissible" role="alert">
          <ul>
            {!! implode('', $errors->all('<li>:message</li>')) !!}

          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <form action="{{ route('company.store') }}" method="post">
        @csrf
        <div class="mb-3">
          <label for="" class="form-label">Name</label>
          <input type="text" class="form-control" value="{{ old('name') }}" name="name" required>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Address</label>
          <input type="text" class="form-control" value="{{ old('address') }}" name="address">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Email</label>
          <input type="text" class="form-control" value="{{ old('email') }}" name="email">
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('company.index') }}" class="btn btn-dark">Kembali</a>
        </div>
      </form>
    </div>
  </div>
@endsection
