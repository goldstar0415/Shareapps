@extends('master')
@section('title')
User Profile
@endsection
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.cs') }}s" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('pagelevel_style')
<link href="{{ cdn('assets/pages/css/profile-2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
.changepassword-form .form-control.has-error {
  border: 2px solid #ed6b75 !important;
}
.changepassword-form .form-control.valid {
    border: 1px solid #a0a9b4 !important;
}
</style>
@endsection
@section('content')
  <!-- BEGIN PAGE TITLE-->
  <h3 class="page-title"> User Profile
  </h3>
  <!-- END PAGE TITLE-->
  <!-- END PAGE HEADER-->
  <div class="profile">
      <div class="tabbable-line tabbable-full-width">
          <ul class="nav nav-tabs">
              <li class="active">
                  <a href="#tab_1_1" data-toggle="tab"> Edit Profile </a>
              </li>
              @if( Auth::user()->user_role == 2 && Auth::user()->user_role_check == 1)
              <li>
                  <a href="#tab_1_6" data-toggle="tab"> Help </a>
              </li>
              @endif
          </ul>
          <div class="tab-content">
              <div class="tab-pane active" id="tab_1_1">
                  <div class="row">
                      <div class="col-md-3">
                          <ul class="list-unstyled profile-nav">
                              <li>
                                  @if(file_exists('assets/images/avatar'.'/'.Auth::User()->id.'.jpg'))
                                    <img class="img-responsive pic-bordered" alt="" src="{{ cdn('assets/images/avatar').'/'.Auth::User()->id.'.jpg'}}" />
                                  @else
                                    <img class="img-responsive pic-bordered" alt="" src="{{ cdn('assets/images/avatar/nophoto.jpg') }}" />
                                  @endif
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-9">
                          <div class="row">
                              <div class="col-md-8 profile-info">
                                  <h1 class="font-green sbold uppercase">{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}</h1>
                                  <p>Country &nbsp;: {{ Auth::user()->country_name }}</p>
                                  <p>Company Name&nbsp;: {{ Auth::user()->company_name }}</p>
                                  <p>Email &nbsp;: {{ Auth::user()->email }}</p>
                                  <p>Phone Number &nbsp;: {{ Auth::user()->phone_number }}</p>
                              </div>
                              <!--end col-md-8-->
                          </div>
                          <!--end row-->
                      </div>
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
                  <div class="row profile-account">
                      <div class="col-md-3">
                          <ul class="ver-inline-menu tabbable margin-bottom-10">
                              <li class="active">
                                  <a data-toggle="tab" href="#tab_1-1">
                                      <i class="fa fa-cog"></i> Personal info </a>
                                  <span class="after"> </span>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_2-2">
                                      <i class="fa fa-picture-o"></i> Change Avatar </a>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_3-3">
                                      <i class="fa fa-lock"></i> Change Password </a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-9">
                          <div class="tab-content">
                              <div id="tab_1-1" class="tab-pane active">
                                  <form role="form" action="{{url('changeUserinfo')}}" style="margin-bottom:20px;"  method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label class="control-label">First Name</label>
                                          <input type="text" placeholder="John" class="form-control" name="fname" value="{{Auth::user()->first_name}}" />
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label">Last Name</label>
                                          <input type="text" placeholder="Doe" class="form-control" name="lname" value="{{Auth::user()->last_name}}" /> </div>
                                      <div class="margiv-top-10">
                                          <button type="submit" href="javascript:;" class="btn green"> Save Changes </a>
                                      </div>
                                  </form>
                                  <form role="form" action="{{url('changePhoneNumber')}}" style="margin-bottom:20px;"  method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label class="control-label">Mobile Number</label>
                                          <input type="text" placeholder="+1 646 580 DEMO (6284)" name="phone_number" value="{{Auth::user()->phone_number}}" class="form-control" /> </div>
                                      <div class="margiv-top-10">
                                          <button type="submit" href="javascript:;" class="btn green"> Save Changes </button>
                                      </div>
                                  </form>
                                  <form role="form" action="{{ url('changeEmailAddress')}}"  method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label class="control-label">Your Email</label>
                                          <input type="text" placeholder="example@mail.com" name="email" value="{{Auth::user()->email}}" class="form-control" /> </div>
                                      <div class="margiv-top-10">
                                          <button type="submit" href="javascript:;" class="btn green"> Save Changes </button>
                                      </div>
                                  </form>
                              </div>
                              <div id="tab_2-2" class="tab-pane">
                                  <form action="{{url('changeAvatar')}}" role="form" method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <div class="fileinput fileinput-new" data-provides="fileinput">
                                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                              <div>
                                                  <span class="btn default btn-file">
                                                      <span class="fileinput-new"> Select image </span>
                                                      <span class="fileinput-exists"> Change </span>
                                                      <input type="file" name="user_image"> </span>
                                                  <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="margin-top-10">
                                          <button class="btn green" type="submit"> Submit </button>
                                      </div>
                                  </form>
                              </div>
                              <div id="tab_3-3" class="tab-pane">
                                  <form action="{{url('changePassword')}}" class="changepassword-form" method="post" enctype="multipart/form-data" >
                                      <div class="alert alert-danger display-hide">
                                          <button class="close" data-close="alert"></button>
                                          <span>Enter any username and password. </span>
                                      </div>
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label class="control-label">Current Password</label>
                                          <input type="password" class="form-control" name="current-password" required /> </div>
                                      <div class="form-group">
                                          <label class="control-label">New Password</label>
                                          <input type="password" autocomplete="off" class="form-control form-group" id="change_password" name="password" required /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Re-type New Password</label>
                                          <input type="password" autocomplete="off" class="form-control" name="password_confirmation" required /> </div>
                                      <div class="margin-top-10">
                                          <button type="submit" class="btn green"> Change Password </button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <!--end col-md-9-->
                  </div>
              </div>
              <div class="tab-pane" id="tab_1_6">
                  <div class="row">
                      <div class="col-md-3">
                          <ul class="ver-inline-menu tabbable margin-bottom-10">
                              <li class="active">
                                  <a data-toggle="tab" href="#tab_1">
                                      <i class="fa fa-briefcase"></i> Terms Of Service </a>
                                  <span class="after"> </span>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_2">
                                      <i class="fa fa-group"></i> Privacy Policy </a>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_3">
                                      <i class="fa fa-leaf"></i> About Us </a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-9">
                          <div class="tab-content">
                              <div id="tab_1" class="tab-pane active">
                                  <div id="accordion1" class="panel-group">
                                    <form class="form-horizontal form-bordered" id="terms-form" action="{{url('termsServiceEdit')}}" method="POST" enctype="multipart/form-data">
                                      <div class="alert alert-success" style="display:none">Save successfully</div>
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                          <div class="form-group last">
                                              <div class="col-md-12">
                                                  <div name="summernote" id="summernote_1"> </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-actions">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <button type="submit" class="btn green">Save Change</button>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                  </div>
                              </div>
                              <div id="tab_2" class="tab-pane">
                                  <div id="accordion2" class="panel-group">
                                    <form class="form-horizontal form-bordered" id="privacy-form" action="{{url('privacyPolicyEdit')}}" method="POST" enctype="multipart/form-data">
                                      <div class="alert alert-success" style="display:none">Save successfully</div>
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                          <div class="form-group last">
                                              <div class="col-md-12">
                                                  <div name="summernote" id="summernote_2"> </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-actions">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <button type="submit" class="btn green">Save Change</button>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                  </div>
                              </div>
                              <div id="tab_3" class="tab-pane">
                                  <div id="accordion3" class="panel-group">
                                    <form class="form-horizontal form-bordered" id="about-us-form" action="{{url('aboutUsEdit')}}" method="POST" enctype="multipart/form-data" >
                                      <div class="alert alert-success" style="display:none">Save successfully</div>
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                          <div class="form-group last">
                                              <div class="col-md-12">
                                                  <div name="summernote" id="summernote_3"> </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-actions">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <button type="submit" class="btn green">Save Change</button>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!--end tab-pane-->
          </div>
      </div>
  </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/pages/scripts/components-editors.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/pages/scripts/login-5.js') }}" type="text/javascript"></script>
<script>
  var getservicedataUrl = "{{ url('getSiteHelp') }}";
  $.get(getservicedataUrl, function (data) {
     $('#terms-form').find('div.panel-body').html(data[0]['terms_service']);
     $('#privacy-form').find('div.panel-body').html(data[0]['privacy_policy']);
     $('#about-us-form').find('div.panel-body').html(data[0]['about_us']);
 });
</script>
@endsection
