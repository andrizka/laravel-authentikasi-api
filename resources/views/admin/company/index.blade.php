@extends('admin.layouts.index')
@section('content')
  <div class="card">
    <div class="card-header">
      <a href="{{ route('company.create') }}" class="btn btn-primary">Tambah</a>
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
              <th>Name</th>
              <th>Address</th>
              <th>Email</th>
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
        ajax: "{{ route('company.index') }}",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'address',
            name: 'address'
          },
          {
            data: 'email',
            name: 'email'
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
