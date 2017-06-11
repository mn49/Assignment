@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <hr>
                    <a href="/posts/create" class="btn btn-block btn-primary">Create a new post!</a>
                    <hr>
                    
						@foreach($posts as $post)
							<div class="well">
								<h3>
									<a href="/posts/{{ $post->id }}">
										{{ $post->title }}
									</a>	
								</h3>
								<small class='pull-right'>{{ $post->created_at }}</small>
							</div>
						@endforeach
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
