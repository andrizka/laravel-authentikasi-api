@extends('admin.layouts.index')
@section('content')
  <div class="card">
    <div class="card-header">
      <a href="{{ route('employees.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card-body">
      @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
          {{ Session::get('message') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>
      @endif
      <div class="table-responsive">
        <table id="data-tables" class="table  table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Company Name</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var table = $('#data-tables').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('employees.index') }}",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'first_nm',
            name: 'first_nm'
          },
          {
            data: 'last_nm',
            name: 'last_nm'
          },
          {
            data: 'email',
            name: 'email'
          },
          {
            data: 'phone',
            name: 'phone'
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          },
        ]
      });
    });
  </script>
@endsection
