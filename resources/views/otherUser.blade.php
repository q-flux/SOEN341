
@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">

              
                <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" class="img-rounded img-responsive" alt="Cinque Terre" style="
                width: 100%;">
                 <div class="container">
                        <br>
                <h3>Hi my name is <span style="border-bottom:1px solid black" >{{$output[1]}}</span></h3>
                <h5>About Me</h5>
                 <p>{{$output[4]}}</p> 
                @if ($output[3] > 0)
                    <a class="btn btn-primary" href="/follow/{{$output[2]}}"> Unfollow </a>
            
                @else
                    <a class="btn btn-primary" href="/follow/{{$output[2]}}"> Follow </a>
                @endif  
                 </div>

                {{-- <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" class="img-rounded img-responsive" alt="Cinque Terre" style="
                width: 100%;">
         <div class="container">
                <br>
                <h3>Hi my name is <span style="border-bottom:1px solid black" > {{Auth::user()->name}} </span></h3>
                <h5>About Me</h5>
         <p>{{Auth::user()->biography}}</p> --}}
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
                                <a class="btn btn-primary" id="like" href="/like/{{$tweet->id}}" class="btn btn-default" data-tweetID="{{ $tweet->id }}">
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
