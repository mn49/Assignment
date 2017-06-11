@extends('layouts.master')

@section('content')
	<h1>Posts</h1>
	@if($show)
	<div class="jumbotron">
		<h1 align="center">{{ $show->title }}</h1>
		<hr>
		<img style="width:100%" src="/storage/cover_images/{{ $show->cover_image }}">
		<hr>
		<small>Created at {{ $show->created_at }} by {{ $show->user->name }}</small>
		<hr>
		<p align="justify">{!! $show->body !!}</p>
	</div>
	
	<hr>
	<a href="/donate/{{ $show->id }}" class="btn btn-primary btn-block">Donate ${{ $show->cost->price }} for this author!</a>
	<hr>
	
	<h2>Comments:</h2>
	
		@foreach($show->comment as $comment)
			<div class="well">
				<h5>{!! $comment->user->name !!} commented:</h5>
				<hr>				
				{!! $comment->body !!}
			</div>
		@endforeach
	
	<hr>
		
		
		@if(!Auth::guest())
		<h2>Add Comments:</h2>
			{!! Form::open(['action'=>'CommentController@store', 'method'=>'POST']) !!}
			
				<div class="form-group">
					{{ Form::hidden('post_id',$show->id) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('body', 'Your Comments :') }}
					{{ Form::textarea('body', '', ['class' => "form-control", 'placeholder' => 'The post content goes here', 'id' => 'article-ckeditor'])}}
				</div>
				
				{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-block']) }}
			
			{!! Form::close() !!}
			
		@endif
	
	<hr>
			@if(!Auth::guest())
			<a href="/posts/{{$show->id}}/edit" class="btn btn-block btn-default">
				Edit Post!
			</a>
			
				{!! Form::open(['action'=>['PostsController@destroy', $show->id], 'method' => 'POST']) !!}
					{{ Form::hidden('_method','DELETE') }}
					{{ Form::submit('Delete', ['class'=>'btn btn-block btn-danger']) }}
				{!! Form::close() !!}
			@endif	
			
		@else
			<p>This post has been missing for a while now</p>
	
	@endif
@endsection
