Hi {{$content->first_name}}&nbsp;{{$content->last_name}},
<p> Your registration is completed. please click the linkt to get access.</p>

<a href="{{url('confirmation/'.$content->token)}}">{{url('confirmation/'.$content->token)}}</a>
