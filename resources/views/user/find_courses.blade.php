@extends('layouts.app')
@section('title', 'Find Courses')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@yield('title')</h4>

                <div class="mb-4">
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
                                            <th>Duration</th>
                                            <th>Amount (NGN)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $course->name }}</td>
                                                <td>{{ $course->duration }} hours</td>
                                                <td>{{ number_format($course->amount, 2) }}</td>
                                                <td><a href="/user/courses/add/{{ $course->id }}" onclick="return confirm('Are you sure you want to add this course to your course list?')" class="btn btn-outline-success btn-sm">Add to my courses</a></td>
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
            </div>
        </div>
    </div>
</div>
@endsection