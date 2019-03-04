@extends('layouts.app')

@section('content')
<p><h1>Here is your feed!!</h1> </p>
@foreach ($f_id as $fid)
     @foreach ($names as $nam)
       <td class="table-text">
           <div>{{ $nam->name }}</div>
       </td>
      @foreach ($tweets as $tweet)
       <tr>
           <!-- Task Name -->
           <td class="table-text">
               <div>{{ $tweet->tweet_text }}</div>
           </td>
           <thead>
                <th>{{$tweet->time_posted}}</th>
                <th>&nbsp;</th>
            </thead>
          </tr>
    @endforeach;
@endforeach;
@endforeach;
@endsection
