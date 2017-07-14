@extends('create-project-template')


@section('content')

<div class="panel panel-primary">	
			<div class="panel-heading">Create new project
            @if ($errors->any())
                <h4 class="alert alert-danger">{{$errors->first()}}</h4>
                @endif
            </div>
    
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'projects.store', 'class' => 'form-horizontal panel']) !!}	
					<div class="form-group {!! $errors->has('code') ? 'has-error' : '' !!}">
						{!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Project code']) !!}
						{!! $errors->first('code', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
						{!! Form::number('type', null, ['class' => 'form-control', 'placeholder' => 'Type']) !!}
						{!! $errors->first('type', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('project_name') ? 'has-error' : '' !!}">
						{!! Form::text('project_name',null, ['class' => 'form-control', 'placeholder' => 'Project name']) !!}
						{!! $errors->first('project_name', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group">
                        {!!Form::label('managerName','Project Manager')!!}
						{!! Form::select('manager', $users,null, ['class'=> 'form-control','id'=>'managerName'])  !!}
					</div>
					<div class="form-group">
						    {{Form::label('content', 'Content')}}
							{{Form::textarea('content',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'summernote'))}}
						</div>
                      <hr>
                   
					</div>
					{!! Form::submit('Send', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Back
		</a>


@endsection


