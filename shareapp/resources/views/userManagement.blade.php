@extends('master')
@section('title')
User Management
@endsection
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <!-- BEGIN PAGE TITLE-->
  <h3 class="page-title"> Managed Datatables
      <small>managed datatable samples</small>
  </h3>
  <!-- END PAGE TITLE-->
  <!-- END PAGE HEADER-->
  <div class="m-heading-1 border-green m-bordered">
      <h3>User Management page</h3>
      <p> In this page ...<br />1 . You can edit and delete the users, if your level is Super Admin, you can have full access(you can edit and delete the admin).<br />
        2 . But if your level is Admin, You have the right to edit only the users registered in your app.</p>
      <p>Now, Your level is @if(Auth::user()->user_role == 2) <strong>Super Admin</strong> @elseif(Auth::user()->user_role == 1) <strong>Admin</strong> @endif.</p>
  </div>
  <div class="row">
      <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> User Management</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                      <thead>
                          <tr>
                              <th>
                                  <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                              <th> User Name </th>
                              <th> Email </th>
                              <th> Company Name </th>
                              <th> Phone Number </th>
                              <th> Level </th>
                              <th> Action </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                          @if(Auth::user()->user_role > $user->user_role)
                            <tr class="odd gradeX" id="userlist_{{$user->id}}">
                                <td>
                                    <input type="checkbox" class="checkboxes" value="1" /> </td>
                                <td> {{$user->first_name}} {{$user->last_name}} </td>
                                <td>
                                    <a href="mailto:{{$user->email}}"> {{$user->email}} </a>
                                </td>
                                <td> {{$user->company_name}} </td>
                                <td class="center"> {{$user->phone_number}} </td>
                                <td class="center"> @if($user->user_role == 1) ADMIN @else User @endif</td>
                                <td align='center'>
                                  <a type="button" onclick="edit_user({{$user->id}})" class="btn btn-default green user-managebutton-size">@if($user->user_role == 1)As User @else As Admin @endif</a>
                                    <a type="button" onclick="delete_user({{$user->id}})" class="btn btn-default red-flamingo user-managebutton-size">Delete</a>
                                </td>
                            </tr>
                            @elseif(Auth::user()->email == $user->email)
                              <tr class="odd gradeX" id="userlist_{{$user->id}}">
                                <td>
                                    <input type="checkbox" class="checkboxes" value="1" /> </td>
                                <td> {{$user->first_name}} {{$user->last_name}} </td>
                                <td>
                                    <a href="mailto:{{$user->email}}"> {{$user->email}} </a>
                                </td>
                                <td> {{$user->company_name}} </td>
                                <td class="center"> {{$user->phone_number}} </td>
                                <td class="center"> @if($user->user_role > 1) S ADMIN @elseif($user->user_role == 1) ADMIN @else User @endif</td>
                                <td align='center'>
                                  <a type="button" class="btn btn-default green user-managebutton-size">@if($user->user_role > 1) S ADMIN @elseif($user->user_role == 1) ADMIN @else  User @endif</a>
                                    <a type="button" class="btn btn-default red-flamingo user-managebutton-size">Delete</a>
                                </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
      </div>
  </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection
@section('pagelevel_script_script')
<script src="{{ cdn('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
<script>
  function delete_user(id){
    url = "{{url('delete-user')}}";
    swal({
      title: "Are you sure?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete user!",
      cancelButtonText: "No, cancel plx!",
      closeOnConfirm: false,
      closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
          axios.post(url, {user_id:id})
          .then(function (response) {
              $("#userlist_"+ id).remove();
              swal("Deleted!", "Your imaginary file has been deleted.", "success");
          })
          .catch(function (error) {
            console.log(error);
          });
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
  };
  function edit_user(id){
    console.log(id);
    url = "{{url('levelChange')}}";
    url1 = "{{url('user-management')}}";

    axios.post(url, {user_id:id})
    .then(function (response) {
        window.location.replace(url1);
    })
    .catch(function (error) {
      console.log(error);
    });
  }
</script>
@endsection
