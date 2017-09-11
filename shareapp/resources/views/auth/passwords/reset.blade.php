@extends('auth.authMaster')
@section('title')
reset password
@endsection
@section('customcss')
<link href="{{ cdn('css/auth/login.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <h1>Reset Password</h1>
  <form action="{{ route('password.request') }}" class="register-form" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="token" value="{{ $token }}">
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
          <div class="col-sm-12">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required/>
              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
          </div>
          <div class="col-sm-12">
              <input class="form-control form-control-solid placeholder-no-fix form-group" id="register_password" type="password" autocomplete="off" placeholder="Password" name="password" required/>
          </div>
          <div class="col-sm-12">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Confirm Password" name="password_confirmation"/>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 text-left">
              <button class="btn blue" type="submit">Reset</button>
          </div>
      </div>
  </form>
@endsection
