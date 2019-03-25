@extends('layouts.app')
@section('content')
<div class="container">
  @include('inc.messages')
  <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">profile <a href="/home" class="pull-right btn btn-default btn-xs">Go Back</a></div>
              <div class="panel-body">
                  {!!Form::open(['action' => 'PhotosController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                  {{Form::bsText('tweet_text', '', ['placeholder' => 'tweet_text'])}}
                  {{Form::file('photo')}}
                  {{Form::bsSubmit('submit')}}
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
  </div>
</div>
@endsection