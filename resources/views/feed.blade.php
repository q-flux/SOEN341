@extends('layouts.app')
@section('content')
<div class="container">
        <h1>Your Feed</h1>


@foreach ($f_id as $fid)
@foreach ($names as $nme)
@if($nme->id == $fid->follow_id)
<td>
<hr>
<h5 style="color:blue"><div>@ {{ $nme->name }}</div></h5>
</td>
      @foreach ($tweets as $tweet)
      @if($tweet->user_id == $fid->follow_id)

       <tr>
           <!-- Task Name -->

           <td class="table-text">
              <h4><div>{{ $tweet->tweet_text }}</div></h4>
           </td>
           <tr>
                <td>
                <a class="btn btn-primary" id="like" href="/like/{{$tweet->id}}" class="btn btn-default" data-tweetID="{{ $tweet->id }}">
                            {{ $tweet->like_cnt }} Like
                </a>
                </td>
            </tr>
            <hr>
           <thead>
              <h6><small>{{$tweet->time_psosted}}</small></h6>
            </thead>
          </tr>
          @endif
    @endforeach
    @endif
    @endforeach
@endforeach
</div>
@endsection
