@extends('auth.sitehelpmaster')
@section('title')
Terms and conditions
@endsection
@section('helptitle')
Terms and Conditions
@endsection
@section('content')
  <?php echo html_entity_decode($helpdata->terms_service); ?>
@endsection
