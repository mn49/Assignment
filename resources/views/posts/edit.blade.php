@extends('layouts.master')

@section('content')
	<h1>Edit Posts</h1>
	{!! Form::open(['action'=>['PostsController@update',$edit_post->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
		
		<div class="form-group">
			{{ Form::label('title', 'Title') }}
			{{ Form::text('title', $edit_post->title, ['class' => "form-control", 'placeholder' => 'The title goes here']) }}
		</div>
		
		<div class="form-group">
			{{ Form::label('body', 'Body') }}
			{{ Form::textarea('body', $edit_post->body, ['class' => "form-control", 'placeholder' => 'The post content goes here', 'id' => 'article-ckeditor'])}}
		</div>
		
		<div class="form-group">
			{{ Form::label('donation', 'Donation Value for This Article') }}
			{{ Form::text('donation', $edit_cost->price, ['class' => "form-control", 'placeholder' => 'Please enter a value in USD'])}}
		</div>
		
		<div class="form-group">
			{{ Form::file('cover_image') }}
		</div>
		{{ Form::hidden('_method','PUT') }}
		
		{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-block']) }}
	{!! Form::close() !!}
@endsection
