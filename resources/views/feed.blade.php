@extends('layouts.app')

@section('content')
<p><h1>Here is your feed!!</h1> </p>
@foreach ($f_id as $fid)
@foreach ($names as $nme)
@if($nme->id == $fid->follow_id)
<td>
<h2><div>{{ $nme->name }}</div></h2>
</td>
      @foreach ($tweets as $tweet)
      @if($tweet->user_id == $fid->follow_id)

       <tr>
           <!-- Task Name -->

           <td class="table-text">
              <h4><div>{{ $tweet->tweet_text }}</div></h4>
           </td>
           <button type="submit" class="btn btn-default">
               <i class="fa fa-plus"></i> Like
           </button>
           <thead>
              <h6><small>{{$tweet->time_posted}}</small></h6>
            </thead>
          </tr>
          @endif
    @endforeach
    @endif
    @endforeach
@endforeach
@endsection
