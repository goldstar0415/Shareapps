@extends('auth.authMaster')
@section('title')
Register
@endsection
@section('customcss')
<link href="{{ cdn('css/auth/register.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <h1>Signup/Create Account</h1>
  <form action="{{ route('register') }}" class="register-form" method="post">
      {{ csrf_field() }}
      @if (session('status'))
          <div class="alert alert-danger">
              <button class="close" data-close="alert"></button>
              {{ session('status') }}
          </div>
      @endif
      <div class="row">
          <div class="col-sm-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required/>
            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="col-sm-3">
            <select class="form-control form-control-solid placeholder-no-fix form-group" name="phoneCountry" style="width:100%;border:0;border-bottom:1px solid #a0a9b4;">
              @foreach($countries as $key => $country)
                <option <?php if($key == 'US') echo 'selected' ?> value="{{$key}}">{{$country}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-3">
            @if (session('status'))
                <input class="form-control form-control-solid placeholder-no-fix form-group has-error" type="number" autocomplete="off" placeholder="Phone Number" value="{{ old('phonenumber') }}" name="phonenumber" required/>
            @else
                <input class="form-control form-control-solid placeholder-no-fix form-group" type="number" autocomplete="off" placeholder="Phone Number" value="{{ old('phonenumber') }}" name="phonenumber" required/>
            @endif
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Company name" value="{{ old('company_name') }}" name="company_name" required/> </div>
          <div class="col-sm-3">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="First name" value="{{ old('fname') }}" name="fname" required/> </div>
          <div class="col-sm-3">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Last name" value="{{ old('lname') }}" name="lname" required/> </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" id="register_password" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Confirm Password" name="password_confirmation" required/> </div>
      </div>
      <div class="row">
          <div class="col-sm-12">
              <div class="rem-password" style="margin-bottom:20px;">
                  <label style="cursor:pointer;"><input type="checkbox" name="tnc" class="rem-checkbox" /> I agree to the </label> <a class="site-terms-service-btn" href="{{url('terms-and-condition')}}" target="_blank">Terms of Service</a> and <a class="site-privacy-policy-btn" href="{{url('privacy-policy')}}" target="_blank"> Privacy Policy </a>
                  <div id="register_tnc_error"> </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-8 text-left" style="margin-bottom:20px;">
              <a class="btn grey" href="{{url('login-page')}}">Back to Login Page</a>
          </div>
          <div class="col-sm-4 text-right">
              <button class="btn blue" type="submit">Proceed</button>
          </div>
      </div>
  </form>
@endsection
