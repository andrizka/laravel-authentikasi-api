@extends('admin.layouts.index')
@section('content')
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Welcome Admin! 🎉</h5>
              <p class="mb-4">Selamat datang kembali, Admin! Semoga harimu menyenangkan.</p>

            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <i class="bx bx-building-house rounded bg-success p-2 text-white"></i>
                </div>
              </div>
              <span class="fw-medium d-block mb-1">Company</span>
              <h3 class="card-title mb-2">{{ count($company) }}</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <i class="bx bx-user rounded bg-info p-2 text-white"></i>
                </div>
              </div>
              <span class="fw-medium d-block mb-1">Employees</span>
              <h3 class="card-title mb-1">{{ count($employees) }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
