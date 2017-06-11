@extends('layouts.master')

@section('content')
	<div class="jumbotron text-center">
		<h1>Welcome</h1>
		<p>- A Simple Blog With a Simple Function -</p>
		<p>
		@if(Auth::guest())
		<a class="btn btn-primary btn-lg" href="/login" role="button">
			Login
		</a>
		<a class="btn btn-success btn-lg" href="/register" role="button">
			Register
		</a>
		@endif
		</p>
	</div>
@endsection
