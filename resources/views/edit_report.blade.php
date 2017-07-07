@extends('post-template')


@section('content')
<div class="col-sm-offset-3 col-sm-6">
@if(session()->has('ok'))
			<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
@elseif($errors->any())
     <div class="alert alert-danger">{!!$errors->first()!!}</div>
@endif
</div>

<div class="alert alert-warning col-sm-offset-3 col-sm-6 text-center"> You can't upload files for now </div>
<div class="col-sm-offset-3 col-sm-6">
    {{Form::model($report, ['route' => ['post.update',$report->id], 'method'=>'put' ])}}
<div class="box-body">
<div class="form-group">
{{Form::label('title', 'Title')}}
{{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Title'))}}
</div>
<div class="form-group">
{{Form::label('body', 'Content')}}
{{Form::textarea('body',$report->description,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'summernote'))}}
</div>
<div class="form-group">
     {{Form::submit('Publish Post',array('class' => 'btn btn-primary btn-sm'))}} </div>
{{Form::close()}}
</div>
</div>


@endsection