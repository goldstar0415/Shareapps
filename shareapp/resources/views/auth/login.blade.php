@extends('auth.authMaster')
@section('title')
Login
@endsection
@section('customcss')
<link href="{{ cdn('css/auth/login.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <h1>Login</h1>
  <form action="{{ url('login-page') }}" class="login-form" method="post">
      {{ csrf_field() }}
      <div class="alert alert-danger display-hide">
          <button class="close" data-close="alert"></button>
          <span>Enter any Email and password. </span>
      </div>
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
      <div class="row">
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required/>
          </div>
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required/>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-4">
              <div class="rem-password">
                  <label style="cursor:pointer;"><input type="checkbox" name="remember" class="rem-checkbox" />Remember Me</label>
              </div>
          </div>
          <div class="col-sm-8 text-right">

              <button class="btn blue" type="submit">Sign In</button>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 text-left">
            <div class="forgot-password" style="margin-right:0;padding-top:20px;">
                <a href="{{url('forget-password')}}" id="forget-password" class="forget-password" style="color:#085af5">Forgot Password?</a>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 text-left">
            <div class="forgot-password" style="margin-right:0;padding-top:20px;">
            <label style="font-size:12px;">Don't have account? </label><a href="{{url('register-account')}}" style="font-size:13px;color:#085af5;"> Create New Account</a>
            </div>
          </div>
      </div>
  </form>
@endsection
