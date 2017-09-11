@extends('admin.adminMaster')
@section('content')
<form class="forget-form" action="{{url('admin/password-email')}}" method="post">
    {{ csrf_field() }}
    <h3 class="font-green">Forget Password ?</h3>
    <p> Enter your e-mail address below to reset your password. </p>
    <div class="form-group">
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
    <div class="form-actions">
        <a type="button" href="{{url('admin/login')}}" class="btn btn-default">Back</a>
        <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
    </div>
</form>
@endsection
