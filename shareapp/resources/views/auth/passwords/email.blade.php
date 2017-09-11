@extends('auth.authMaster')
@section('title')
Forget password
@endsection
@section('customcss')
<link href="{{ cdn('css/auth/email.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <h1>Share Apps Account Recovery</h1>
  <form class="forget-form" action="{{ url('password-email') }}" method="post">
      {{ csrf_field() }}
      <h3 class="font-green">Forgot Password ?</h3>
      <p> Enter your e-mail address below to reset your password. </p>
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      <div class="form-group">
          <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" value="{{ old('email') }}" placeholder="Email" name="email" /> </div>
      <div class="form-actions">
          <a class="btn grey btn-default" href="{{url('login-page')}}">Back</a>
          <button type="submit" class="btn blue btn-success uppercase pull-right">Submit</button>
      </div>
  </form>
  <!-- END FORGOT PASSWORD FORM -->
@endsection
