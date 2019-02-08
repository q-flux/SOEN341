
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
           
               <img src="" alt=".." class="img-thumbnail">
           
        </div>
        <div class="col-md-8">
        @include('common.errors')
        <form action="/tweet" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Tweet Name -->
            <div class="form-group">
                <label for="tweet" class="col-sm-3 control-label">What's happening?</label>

                <div class="col-sm-12">
                    <input type="text" name="tweet" id="tweet-name" class="form-control">
                </div>
            </div>

            <!-- Add Tweet Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Tweet
                    </button>
                </div>
            </div>
        </form>
           
               

        @if (count($tweets) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
               Your Posts
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings
                    <thead>
                        <th>Date</th>
                        <th>&nbsp;</th>
                    </thead> -->

                    <!-- Table Body -->
                    <tbody>
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

                                <td>
                                    <!-- TODO: Delete Button -->
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
