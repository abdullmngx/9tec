@extends('layouts.auth')
@section('title', 'Login')
@section('content')
 <!-- Form -->
 <form class="js-validate needs-validation" novalidate method="post">
    @csrf
    <div class="text-center">
    <div class="mb-5">
        <h1 class="display-5">Sign in</h1>
        <p>Don't have an account yet? <a class="link" href="{{ route('user.register') }}">Sign up here</a></p>
    </div>
    </div>

    <!-- Form -->
    <div class="mb-4">
    <label class="form-label" for="signinSrEmail">Your email</label>
    <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail" tabindex="1" placeholder="email@address.com" aria-label="email@address.com" required>
    <span class="invalid-feedback">Please enter a valid email address.</span>
    </div>
    <!-- End Form -->

    <!-- Form -->
    <div class="mb-4">
    <label class="form-label w-100" for="signupSrPassword" tabindex="0">
        <span class="d-flex justify-content-between align-items-center">
        <span>Password</span>
        <a class="form-label-link mb-0" href="/authentication-reset-password-basic.html">Forgot Password?</a>
        </span>
    </label>

    <div class="input-group input-group-merge" data-hs-validation-validate-class>
        <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="8+ characters required" aria-label="8+ characters required" required minlength="8" data-hs-toggle-password-options='{
                "target": "#changePassTarget",
                "defaultClass": "bi-eye-slash",
                "showClass": "bi-eye",
                "classChangeTarget": "#changePassIcon"
                }'>
        <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
        <i id="changePassIcon" class="bi-eye"></i>
        </a>
    </div>

    <span class="invalid-feedback">Please enter a valid password.</span>
    </div>
    <!-- End Form -->

    <!-- Form Check -->
    <div class="form-check mb-4">
    <input class="form-check-input" type="checkbox" id="termsCheckbox" name="remember">
    <label class="form-check-label" for="termsCheckbox">
        Remember me
    </label>
    </div>
    <!-- End Form Check -->

    <div class="d-grid">
    <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
    </div>
</form>
<!-- End Form -->
@endsection