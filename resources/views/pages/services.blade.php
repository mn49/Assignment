@extends('layouts.master')

@section('content')
		<h1>{{ $title }}</h1>
		@if(count($services))
			<ul class="list-group">
			@foreach($services as $ser)
				<li class="list-group-item">{{ $ser }}</li> 
			@endforeach
			</ul>
		@endif
@endsection
