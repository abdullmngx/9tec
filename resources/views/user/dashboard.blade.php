@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Stats -->
    <div class="row">
        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100 bg-info" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">My Total Courses</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                  <h2 class="card-title text-inherit text-white">{{ $stat['total_courses'] }}</h2>
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
            </div>
          </a>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100 bg-success" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">My Active Courses</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                  <h2 class="card-title text-inherit text-white">{{ $stat['active_courses'] }}</h2>
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
            </div>
          </a>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100 bg-danger" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">My Inactive Courses</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                  <h2 class="card-title text-inherit text-white">{{ $stat['inactive_courses'] }}</h2>
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
            </div>
          </a>
          <!-- End Card -->
        </div>

      </div>
      <!-- End Stats -->

      <!-- Card -->
      <div class="card mb-3 mb-lg-5">
        <!-- Header -->
        <div class="card-header">
          <div class="row justify-content-between align-items-center flex-grow-1">
            <div class="col-md">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-header-title">Courses</h4>

                <!-- Datatable Info -->
                <div id="datatableCounterInfo" style="display: none;">
                  <div class="d-flex align-items-center">
                    <span class="fs-6 me-3">
                      <span id="datatableCounter">0</span>
                      Selected
                    </span>
                    <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                      <i class="tio-delete-outlined"></i> Delete
                    </a>
                  </div>
                </div>
                <!-- End Datatable Info -->
              </div>
            </div>
            <!-- End Col -->
            <!-- End Col -->
          </div>
          <!-- End Row -->
        </div>
        <!-- End Header -->

        <div class="card-body">
          <div class="card">
            <!-- Header -->
            <div class="card-header">
                <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header-title">Courses</h5>
                    </div>
                </div>

                <div class="col-auto">
                    <!-- Filter -->
                    <form>
                    <!-- Search -->
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text">
                        <i class="bi-search"></i>
                        </div>
                        <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                    </div>
                    <!-- End Search -->
                    </form>
                    <!-- End Filter -->
                </div>
                </div>
            </div>
            <!-- End Header -->
            <div class="card-body p-0">
                <div class="table-responsive datatable-custom">
                    <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                    data-hs-datatables-options='{
                            "order": [],
                            "search": "#datatableWithSearchInput",
                            "isResponsive": false,
                            "isShowPaging": false,
                            "pagination": "datatableWithSearchPagination"
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>Course Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td><span class="legend-indicator bg-{{ $course->status == 'active' || $course->status == 'completed' ? 'primary' : 'danger' }}"></span>{{ $course->status }}</td>
                                <td>
                                  @if($course->status == 'active')
                                      <a href="/user/course/completed/{{ $course->id }}" onclick="return confirm('Are you sure you want to mark this course as completed')" class="btn btn-outline-primary btn-sm">Mark as completed</a>
                                  @elseif ($course->status == 'inactive')
                                      <a href="javascript:void" data-user_course="{{ $course->id }}" class="btn btn-outline-success activate-course">Activate</a>
                                  @else
                                    No Action
                                  @endif
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                <div class="d-flex justify-content-center justify-content-sm-end">
                <nav id="datatableWithSearchPagination" aria-label="Activity pagination"></nav>
                </div>
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
      </div>
      <!-- End Card -->

    </div>
    <!-- End Content -->
@endsection