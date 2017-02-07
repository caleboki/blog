@extends('main')
@section('title', '| Homepage')
@section('content') 

  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">
        <h1>Welcome to my Blog!</h1>
        <p class="lead">Thank you for visiting please read my latest post</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Popuar Post</a></p>
      </div>
    </div>
  </div><!--end of header row -->
  <div class="row">
    <div class="col-md-8">
      @foreach($posts as $post)
        <div class="post">
          <h3>{{ $post->title }}</h3>
          <p>{{ str_limit(strip_tags($post->body), 250) }}</p>
          <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
        </div>
        <hr>
      @endforeach
    </div>
    <div class="col-md-3 col-md-offset">
      <h2>Tags</h2>
      <ul class="list-group">
        @foreach($tags as $tag)
          <li class="list-group-item"><a href="{{ route('tags.show', $tag->id) }}"> {{ $tag->name }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
@endsection
  