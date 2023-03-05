@extends('layouts.app')
@section('title', 'Affiliate Dashboard')
@section('content')
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-info">
                <div class="card-body">
                    <h4 class="text-center text-white">Total Referrals</h4>
                    <h1 class="text-center text-white">{{ $stat['total_refs'] }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning">
                <div class="card-body">
                    <h4 class="text-center text-white">Active Referrals</h4>
                    <h1 class="text-center text-white">{{ $stat['active_refs'] }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success">
                <div class="card-body">
                    <h4 class="text-center text-white">Total Earnings</h4>
                    <h1 class="text-center text-white">NGN {{ number_format($user->balance, 2) }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Refferals</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-striped table-hover table-nowrap table-align-middle card-table" id="datatable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>User</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($refs as $ref)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ref->full_name }}</td>
                                        <td>
                                            @if ($ref->is_active)
                                                <span class="legend-indicator bg-success"></span>Active
                                            @else
                                                <span class="legend-indicator bg-danger"></span>Inactive
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {!! $refs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection