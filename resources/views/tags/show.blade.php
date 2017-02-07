@extends('main')

@section('title', "| $tag->name Tag")

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>
			{{ $tag->name }} Tag <small>{{ $tag->posts()->count() }} {{ $tag->posts()->count() > 1 ? "Posts" : "Post"}}</small>
			</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary pull-right btn-block" style="margin-top:20px;">Edit</a>
		</div>
		<div class="col-md-2">
			{{ Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) }}
				{{ Form::submit('Delete', ['class'=> 'btn btn-danger btn-block', 'style' => 'margin-top:20px'])}}
			{{ Form:: close() }}
		</div>
	</div>
	@if($tag->posts()->count() != 0)
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Tags</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tag->posts as $post)
					<tr>
						<th>{{ $post->id }}</th>
						<td>{{ $post->title }}</td>
						<td>
							@foreach ($post->tags as $tag)
								<span class="label label-default">{{ $tag->name }}</span>
							@endforeach
						</td>
						<td>
						@if (Auth::check())
							<a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a>
						@else
							<a href="{{ url('blog/'.$post->slug) }}" class="btn btn-default btn-xs">View</a>
						@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
    	<p class="text-center lead">There are no posts with tag {{ $tag->name }}</p>
	@endif
@endsection