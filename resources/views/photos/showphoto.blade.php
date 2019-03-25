@extends('layouts.app')
@section('content')
    <br>
    <img src="/storage/photos/{{$photo->photo}}" alt="{{$photo->tweet_text}}">
    <br>
@endsection
