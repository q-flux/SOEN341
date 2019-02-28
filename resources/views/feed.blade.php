@extends('layouts.app')

@section('content')
<p>This is for view feed </p>

@foreach ($tweets as $tweet)
    <thead>
        <th>{{$tweet->time_posted}}</th>
        <th>&nbsp;</th>
    </thead>
    <tr>
        <!-- Task Name -->
        <td class="table-text">
            <div>{{ $tweet->tweet_text }}</div>
        </td>


    </tr>
@endforeach

@endsection
