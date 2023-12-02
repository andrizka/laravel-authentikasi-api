@extends('admin.layouts.index')
@section('content')
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Edit</h5>
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
      <form action="{{ route('employees.update', ['employee' => $employee->id]) }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3 row">
          <div class="col-lg-6">
            <label for="" class="form-label">First Name</label>
            <input type="text" class="form-control" value="{{ $employee->first_nm }}" name="first_nm" required>
          </div>
          <div class="col-lg-6">
            <label for="" class="form-label">Last Name</label>
            <input type="text" class="form-control" value="{{ $employee->last_nm }}" name="last_nm" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Email</label>
          <input type="text" class="form-control" value="{{ $employee->email }}" name="email">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Phone</label>
          <input type="text" class="form-control" value="{{ $employee->phone }}" name="phone">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Company Name</label>
          <select name="company_id" class="form-select">
            @foreach ($company as $item)
              <option @if ($item->id == $employee->company_id) {{ 'selected' }} @endif value="{{ $item->id }}">
                {{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('employees.index') }}" class="btn btn-dark">Kembali</a>
        </div>
      </form>
    </div>
  </div>
@endsection
