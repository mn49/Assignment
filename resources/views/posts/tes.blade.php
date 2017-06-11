@extends('layouts.master')

@section('content')

	<div class="alert alert-success">
		<h1 align="center">Donation Success! Thank you!</h1>
		<hr>
			<div align="center">
			<video autoplay loop>
			  <source src="/storage/cover_images/giphy.mp4" type="video/mp4">
			</video>
			</div>
		<hr>
		<h2 align="center">We have successfully accepted your donation!</h2>
		<table align="center" class="table">
			<th>
				<td>Information</td>
				<td>Value</td>
			</th>
			<tr>
				<td>Payment ID</td>
				<td>{{ $payment->id }}</td>
			</tr>
			<tr>
				<td>Payment Status</td>
				<td>{{ $payment->state }}</td>
			</tr>
			
		</table>
		<hr>
		<a href="/" class="btn btn-block btn-success">Back</a>
	</div>
	
@endsection
