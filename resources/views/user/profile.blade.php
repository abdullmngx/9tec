@extends('layouts.app')
@section('title', 'Bank Setting')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@yield('title')</h4>
                    <div class="mt-4">
                        <form action="" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="account_name">Account Name <span class="text-danger">*</span></label>
                                <input type="text" name="account_name" id="account_name" class="form-control">
                                @if ($errors->has('account_name'))
                                    <span class="text-danger text-sm text-small">{{ $errors->first('account_name') }}</span>                                
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="account_number">Account Number <span class="text-danger">*</span></label>
                                <input type="text" name="account_number" id="account_number" class="form-control">
                                @if ($errors->has('account_number'))
                                    <span class="text-danger text-sm text-small">{{ $errors->first('account_number') }}</span>                                
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="Bank">Bank <span class="text-danger">*</span></label>
                                <select name="bank" id="bank" class="form-control">
                                    <option value="">Select bank</option>
                                </select>
                                @if ($errors->has('bank'))
                                    <span class="text-danger text-sm text-small">{{ $errors->first('bank') }}</span>                                
                                @endif
                            </div>
                            @if(session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>                            
                            @endif
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection