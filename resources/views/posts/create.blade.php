@extends('main')
@section('title', '| Create New Post')
@section('stylesheets')

{!! Html::style('css/parsley.css')!!}
{!! Html::style('css/select2.min.css') !!}
<script src="//cdn.tinymce.com/4.4/tinymce.min.js"></script>
<script>
    tinymce.init({
  selector: 'textarea',
  height: 500,
  plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
</script>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<h1>Create Post</h1>
			<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => 'true']) !!}
    			{{ Form::label('title', 'Title:') }}
    			{{ Form::text('title', null, array('class' => 'form-control', 'required' =>'', 'maxlength' => '60')) }}
    			{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top'])}}
    			{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255'))}}
    			{{ Form::label('category', 'Category:', ['class' => 'form-spacing-top']) }}
    			<select class="form-control" name="category_id">
    				@foreach($categories as $category)
	    				<option value='{{ $category->id}}'>
	    				{{ $category->name }}</option>
    				@endforeach
    			</select>

                {{ Form::label('featured_image', 'Upload Featured Image', ['class' => 'form-spacing-top'])}}
                {{ Form::file('featured_image') }}
                {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
                <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value='{{ $tag->id}}'>
                        {{ $tag->name }}</option>
                    @endforeach
                </select>


    			{{ Form::label('body', "Post Body:", ['class' => 'form-spacing-top'])}}
    			{{ Form::textarea('body', null, array('class' => 'form-control'))}}

    			{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection