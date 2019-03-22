@extends('layouts.app')

@section('content')
	@if(count($photos) > 0)
		<?php
			$colcount = count($photos);
			$i = 1;
		?>
	<div id="photos">
		<div class="row text-center">
		<div class="grid-x grid-margin-x">
			@foreach($photos as $photo)
				@if($i == $colcount)
					<div class="cell small-4">
						<a href="/photos/{{$photo->id}}">
							<img class="thumbnail" src="/storage/photos/{{$photo->photo}}" alt="{{$photo->tweet_text}}">
						</a>
						<br>
						<h4>{{$photo->tweet_text}}</h4>
				@else
				<div class="cell small-4">
						<a href="/photos/{{$photo->id}}">
							<img class="thumbnail" src="/storage/photos/{{$photo->photo}}" alt="{{$photo->tweet_text}}">
						</a>
						<br>
						<h4>{{$photo->tweet_text}}</h4>
				@endif
				@if($i % 3 == 0)
				</div></div></div><div class="row text-center"><div class="grid-x grid-margin-x">
				@else
					</div>
				@endif
				<?php $i++; ?>
			@endforeach
		</div>
	</div>
	@else
		<p>No Photos To Display</p>
	@endif

@endsection