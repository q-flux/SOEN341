@extends('layouts.app')
@section('content')
<div class="container">
  @include('inc.messages')
  <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">Edit profile <a href="/home" class="pull-right btn btn-default btn-xs">Go Back</a></div>

              <div class="panel-body">
                  {!!Form::open(['action' => ['ListingsController@update', $listing->id], 'method' => 'POST'])!!}
                  {{Form::bsText('name', $listing->name, ['placeholder' => 'Name'])}}
                  {{Form::bsText('website', $listing->website, ['placeholder' => 'Website'])}}
                  {{Form::bsText('email', $listing->email, ['placeholder' => 'Email'])}}
                  {{Form::bsText('phone', $listing->phone, ['placeholder' => 'Phone'])}}
                  {{Form::bsText('address', $listing->address, ['placeholder' => 'Address'])}}
                  {{Form::bsText('bio', $listing->bio, ['placeholder' => 'About yourself'])}}
                  {{Form::hidden('_method', 'PUT')}}
                  {{Form::bsSubmit('submit')}}
                  {!! Form::close() !!}
              </div>

            </div>
          </div>


        </div>
  </div>
</div>
@endsection
