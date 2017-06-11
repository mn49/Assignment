@extends('layouts.master')


@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<div class="container">
		<div class="row">
			<button onclick="tes()" class="btn btn-success btn-block">
				Get Top 10!
			</button>
			
			<button onclick="tes2()" class="btn btn-primary btn-block">
				Get Stories!
			</button>
		</div>
	<hr>
	
	<div class="jumbotron">
		<p id="hasil">Tes </p>
	</div>
		
	</div>
	
	

<script src="{{ asset('js/mock.js') }}"></script>
@endsection
