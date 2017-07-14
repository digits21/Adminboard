<!-- resources/views/chat.blade.php -->

@extends('single-post-template')

@section('content')
<br><br><br><br><br><br>
<div class="col-sm-offset-2 col-sm-8">
@if(session()->has('ok'))
			<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
@elseif($errors->any())
     <div class="alert alert-danger">{!!$errors->first()!!}</div>
@endif
</div>


<div class="col-sm-offset-2 col-sm-8">
<div class="alert alert-success text-center"> You can upload files as well  </div>
{{Form::open(['route' => 'post.store'])}}
<div class="box-body">
<div class="form-group">

{{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Title'))}}
</div>
<div class="form-group">
{{Form::label('body', 'Content')}}
{{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'summernote'))}}
</div>
<div class="form-group">
     {{Form::submit('Publish Post',array('class' => 'btn btn-primary btn-sm pull-right'))}} </div>
{{Form::close()}}
</div>
    <a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Back
		</a>
</div>
@endsection
