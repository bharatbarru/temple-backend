@extends('frontend.app')

@section('content')
<section class="pt-5 order-online sign-login">
    <div class="container">
        <div class="row justify-content-center pt-6">
            <div class=" col-md-6">

                <div class="card card-body shadow">
                <div class="text-center ">
                    <h1 class="mb-1 h2 text-primary font-700">Sign Up or Login</h1>
                    <p>Sign Up or Login with your social account</p>
                </div>

                <hr class="mb-1">

                {{-- <!-- Traditional Login Form -->
                <form>
                    <div class="form-group">
                        <input type="email" name="login-email" placeholder="Email Address" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="login-password" placeholder="Password" class="form-control">
                        <small><a href="#" class="text-muted">Forgot your password?</a></small>
                    </div>
                    <div class="form-group">
                        <button class="btn-block btn btn-primary" type="submit">Sign in</button>
                    </div>
                </form>

                <div class="text-center text-small text-muted mt-2">
                    <span>Don't have an account yet? <a href="#">Create one</a></span>
                </div> --}}

                <div class="form-group text-center pt-3">
                    @include('customers-auth.social-login-buttons')
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
