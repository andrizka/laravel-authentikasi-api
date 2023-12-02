@extends('admin.layouts.index')
@section('content')
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Detail</h5>
    </div>
    <div class="card-body">
      <form>
        <div class="mb-3 row">
          <div class="col-lg-6">
            <label for="" class="form-label">First Name</label>
            <input type="text" class="form-control" value="{{ $employee->first_nm }}" name="first_nm" readonly>
          </div>
          <div class="col-lg-6">
            <label for="" class="form-label">Last Name</label>
            <input type="text" class="form-control" value="{{ $employee->last_nm }}" name="last_nm" readonly>
          </div>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Email</label>
          <input type="text" class="form-control" value="{{ $employee->email }}" name="email" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Phone</label>
          <input type="text" class="form-control" value="{{ $employee->phone }}" name="phone" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Company Name</label>
          <input type="text" class="form-control" value="{{ $employee->name }}" name="name" readonly>

        </div>
        <div class="mb-3">
          <a href="{{ route('employees.index') }}" class="btn btn-dark">Kembali</a>
        </div>
      </form>
    </div>
  </div>
@endsection
