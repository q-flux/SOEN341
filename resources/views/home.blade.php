
@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">

                <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" class="img-rounded img-responsive" alt="Cinque Terre" style="
                width: 100%;">
         <div class="container">
                <br>
                <h3>Hi my name is <span style="border-bottom:1px solid black" > {{Auth::user()->name}} </span></h3>
                <h5>About Me</h5>
         <p>{{Auth::user()->biography}}</p>
               

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditProfile">Edit <i class="fa fa-pencil"> </i></button>
                <!-- Modal -->
                <div class="modal fade" id="EditProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">About Me</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                                 {{-- @if ($id) --}}
                            <form method="POST" action = "/edit" class="form-horizontal">

                            {{ csrf_field() }}

                                    <div class="form-group">
                              
                                        <textarea class="form-control" rows="5" id="comment" name="biography"></textarea>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>

                                    </div>  
                            </form>
                           
                        </div>
                        </div>
                    </div>
                </div>       
        
        </div>

        <div class="col-md-8">
<<<<<<< HEAD

=======
            
>>>>>>> upstream/master
        @include('common.errors')
        {{-- @if ($id) --}}
        <form method="POST" action = "{{ route('create')}}" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Tweet Name -->
            <div class="form-group">
                <label for="tweet" class="col-sm-3 control-label">What's happening?</label>

                <div class="col-sm-12">
                    <input type="text" onkeyup="countCharacters();" name="tweet" id="tweet-name" class="form-control" maxlength="140">
                    <span id="chars">140</span> /140
                </div>
                <div class="col-sm-12">
                </div>
                <script>
                var el;

                function countCharacters() {
                  var textEntered, countRemaining, counter;
                  textEntered = document.getElementById('tweet-name').value;
                  counter = (140 - (textEntered.length));
                  countRemaining = document.getElementById('chars');
                  countRemaining.textContent = counter;
                }
                el = document.getElementById('tweet-name');
                el.addEventListener('keyup', countCharacters, false);
                </script>
            </div>

            <!-- Add Tweet Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tweet
                    </button>
<<<<<<< HEAD

                    <button type="button" onclick="window.location='{{ url('/feed') }}'">View Feed</button>
=======
                   
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ url('/feed') }}'">View Feed</button>
>>>>>>> upstream/master
                </div>
            </div>
        </form>
        {{-- @endif --}}



        @if (count($tweets) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
               Your Posts
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

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
                                  <form method="POST" action="{{ route('delete', ['id' => $tweet->id])}}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-dark"> Delete</button>
                                  </form>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                          {{ $tweet->like_cnt }} Like

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
