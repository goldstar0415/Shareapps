@extends('auth.sitehelpmaster')
@section('title')
Privacy policy
@endsection
@section('helptitle')
Privacy Policy
@endsection
@section('content')
  <?php echo html_entity_decode($helpdata->privacy_policy); ?>
@endsection
