
@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">

              
                {{-- <h3>{{$output[1][0]->name}}</h3> --}}
                <h3>{{$output[1]}}</h3>
                @if ($output[3] > 0)
                    <a href="/follow/{{$output[2]}}"> You are already following this user </a>
            
                @else
                    <a href="/follow/{{$output[2]}}"> Follow this user </a>
                @endif  
        </div>
   
        <div class="col-md-8">

        @if (count($output[0]) > 0)
        {{-- {{$tweets = $output[0]}} --}}
        <div class="panel panel-default">
            <div class="panel-heading">
               Your Posts
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <tbody>
                        @foreach ($output[0] as $tweet)
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
                            <tr>
                                <td>
                                <a id="like" href="/like/{{$tweet->id}}" class="btn btn-default" data-tweetID="{{ $tweet->id }}">
                                            {{ $tweet->like_cnt }} Like
                                </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

        </div>


    </div>
</div>
@endsection
