@extends('auth.sitehelpmaster')
@section('title')
About Us
@endsection
@section('helptitle')
About Us
@endsection
@section('content')
  <?php echo html_entity_decode($helpdata->about_us); ?>
@endsection
