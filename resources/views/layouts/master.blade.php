<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <title>LSAPPS</title>
        
         <!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
		
		
    </head>
    <body>
		@include('inc.navbar')
		<div class="container">
			
			@include('inc.messages')
			
			@yield('content')
		
		</div>
	
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    </body>
</html>
