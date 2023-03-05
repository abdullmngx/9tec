@extends('layouts.auth')
@section('title', 'Register')
@section('content')
<!-- Form -->
<form class="js-validate needs-validation {{ $errors->any() ? 'was-validated' : '' }}" novalidate method="post" action="/user/register">
    @csrf
    <input type="hidden" name="ref_id" value="{{ $ref_id }}">
    <div class="text-center">
        <div class="mb-5">
        <h1 class="display-5">Create your account</h1>
        <p>Already have an account? <a class="link" href="{{ route('user.login') }}">Sign in here</a></p>
        </div>
    </div>

    <label class="form-label" for="fullNameSrEmail">Full name</label>

    <!-- Form -->
    <div class="row">
        <div class="col-sm-6">
        <!-- Form -->
        <div class="mb-4">
            <input type="text" class="form-control form-control-lg" name="first_name" id="fullNameSrEmail" placeholder="Mark" aria-label="Mark" required>
            <span class="invalid-feedback">Please enter your first name.</span>
        </div>
        <!-- End Form -->
        </div>

        <div class="col-sm-6">
        <!-- Form -->
        <div class="mb-4">
            <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Williams" aria-label="Williams" required>
            <span class="invalid-feedback">Please enter your last name.</span>
        </div>
        <!-- End Form -->
        </div>
    </div>
    <!-- End Form -->

    <!-- Form -->
    <div class="row">
        <div class="col-sm-6">
            <!-- Form -->
            <div class="mb-4">
                <label class="form-label" for="signupSrEmail">Your email</label>
                <input type="email" class="form-control form-control-lg" name="email" id="signupSrEmail" placeholder="Markwilliams@site.com" aria-label="Markwilliams@site.com" required>
                <span class="invalid-feedback">Please enter a valid email address.</span>
            </div>
            <!-- End Form -->
        </div>
        <div class="col-sm-6">
            <!-- Form -->
            <div class="mb-4">
                <label class="form-label" for="signupSrPhone">Your phone</label>
                <input type="text" class="form-control form-control-lg" name="phone_number" id="signupSrPhone" placeholder="+2348000000000" aria-label="+2348000000000" required>
                <span class="invalid-feedback">Please enter a valid phone number.</span>
            </div>
            <!-- End Form -->
        </div>
    </div>
    <!-- End Form -->

    <!-- Form -->
    <div class="mb-4">
        <label class="form-label" for="signupSrPassword">Password</label>

        <div class="input-group input-group-merge {{ $errors->has('password') ? 'is-invalid' : '' }}" data-hs-validation-validate-class>
        <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="8+ characters required" aria-label="8+ characters required" required minlength="8" data-hs-toggle-password-options='{
                    "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                    "defaultClass": "bi-eye-slash",
                    "showClass": "bi-eye",
                    "classChangeTarget": ".js-toggle-password-show-icon-1"
                }'>
        <a class="js-toggle-password-target-1 input-group-append input-group-text" href="javascript:;">
            <i class="js-toggle-password-show-icon-1 bi-eye"></i>
        </a>
        </div>

        <span class="invalid-feedback">Your password is invalid. Please try again.</span>
    </div>
    <!-- End Form -->

    <!-- Form -->
    <div class="mb-4">
        <label class="form-label" for="signupSrConfirmPassword">Confirm password</label>

        <div class="input-group input-group-merge" data-hs-validation-validate-class>
        <input type="password" class="js-toggle-password form-control form-control-lg" name="password_confirmation" id="signupSrConfirmPassword" placeholder="8+ characters required" aria-label="8+ characters required" required minlength="8" data-hs-toggle-password-options='{
                    "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                    "defaultClass": "bi-eye-slash",
                    "showClass": "bi-eye",
                    "classChangeTarget": ".js-toggle-password-show-icon-2"
                }'>
        <a class="js-toggle-password-target-2 input-group-append input-group-text" href="javascript:;">
            <i class="js-toggle-password-show-icon-2 bi-eye"></i>
        </a>
        </div>

        <span class="invalid-feedback">Password does not match the confirm password.</span>
    </div>
    <!-- End Form -->

    <!-- Form Check -->
    <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" value="" id="termsCheckbox" required>
        <label class="form-check-label" for="termsCheckbox">
        I accept the <a href="#">Terms and Conditions</a>
        </label>
        <span class="invalid-feedback">Please accept our Terms and Conditions.</span>
    </div>
    <!-- End Form Check -->
    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <div class="alert alert-danger">{{ $err }}</div>
        @endforeach
    @endif

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">Create an account</button>
    </div>
</form>
<!-- End Form -->
@endsection