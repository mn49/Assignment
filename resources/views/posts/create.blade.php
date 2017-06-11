@extends('layouts.master')

@section('content')
	<h1>Create Posts</h1>
	{!! Form::open(['action'=>'PostsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
		<div class="form-group">
			{{ Form::label('title', 'Title') }}
			{{ Form::text('title', '', ['class' => "form-control", 'placeholder' => 'The title goes here'])}}
		</div>
		
		<div class="form-group">
			{{ Form::label('body', 'Body') }}
			{{ Form::textarea('body', '', ['class' => "form-control", 'placeholder' => 'The post content goes here', 'id' => 'article-ckeditor'])}}
		</div>
		
		<div class="form-group">
			{{ Form::label('donation', 'Donation Value for This Article') }}
			{{ Form::text('donation', '', ['class' => "form-control", 'placeholder' => 'Please enter a value in USD'])}}
		</div>
		
		<div class="form-group">
			{{ Form::file('cover_image') }}
		</div>
		{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-block']) }}
	{!! Form::close() !!}
@endsection
