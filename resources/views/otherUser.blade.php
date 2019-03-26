@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">


            <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" class="img-rounded img-responsive" alt="Cinque Terre"
                style="
                width: 100%;">
            <div class="container">

                @if(count($listings))
                <table class="table table-borderless table-sm">
                    <br> @foreach($listings as $listing)
                    <tr>
                        <td>Name: {{$listing->name}}</td>
                    </tr>
                    <tr>
                        <td>Bio: {{$listing->bio}}</td>
                    </tr>
                    <tr>
                        <td>Location: {{$listing->address}}</td>
                    </tr>
                    <tr>
                        <td>Website: {{$listing->website}}</td>
                    </tr>
                    @endforeach
                </table>
                @endif @if ($output[3] > 0)
                <a class="btn btn-primary" href="/follow/{{$output[2]}}"> Unfollow </a> @else
                <a class="btn btn-primary" href="/follow/{{$output[2]}}"> Follow </a> @endif
            </div>
        </div>

        <div class="col-md-8">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 emphasis">
                        <h2><strong> {{$output[5]}} </strong></h2>
                        <p><strong>Followers</strong></p>
                    </div>
                    <div class="col-xs-12 col-sm-4 emphasis">
                        <h2><strong>{{$output[6]}}</strong></h2>
                        <p><strong>Following</strong></p>
                    </div>
                    <div class="col-xs-12 col-sm-4 emphasis">
                        <h2><strong>{{$output[7]}}</strong></h2>
                        <p><strong>Tweets</strong></p>
                    </div>
                </div>
            </div>

            @if (count($output[0]) > 0) 
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
                            @if ( !empty ( $tweet->photo ) )
                            <tr>
                                <td>
                                    <br>
                                    <a href="/photos/{{$tweet->id}}">
                                                <img class="thumbnail" src="/storage/photos/{{$tweet->photo}}">
                                            </a>
                                </td>
                            </tr>
                            @endif
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