@if(count($errors)>0)
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $e)
				<li>{{ $e }}</li>
			@endforeach
		</ul>	
	</div>
@endif

@if(session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
		
		<div align="center">
		<video autoplay loop>
		  <source src="/storage/cover_images/giphy.mp4" type="video/mp4">
		</video>
		</div>
	
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger">
		{{ session('error') }}
	</div>
@endif

