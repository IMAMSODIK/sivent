@extends('auth.template')

@section('content')
    
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">    
            <div class="login-card login-dark">
                <div>
                    <div>
                        <a class="logo" href="#">
                            <img width="150px" class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo.png') }}" alt="loginpage">
                            <img width="150px" class="img-fluid for-light" src="{{ asset('assets/images/logo/logo_dark.png') }}" alt="loginpage">
                        </a>
                    </div>
                    <div class="login-main"> 
                        <form class="theme-form" action="/login" method="POST">
                            {{ csrf_field() }}
                            <h4>Sign in to account </h4>
                            <p>Enter your email & password to login</p>
                            <div class="form-group">
                                <label class="col-form-label">Username</label>
                                <input class="form-control" type="text" required="" placeholder="Username" name="username">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password </label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="password" required="" placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Remember password</label>
                                </div>
                                <a class="link" href="{{ url('forget-password.html') }}">Forgot password?</a>
                                <div class="text-end mt-3">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                                </div>
                            </div>
                            <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="#">Create Account</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection