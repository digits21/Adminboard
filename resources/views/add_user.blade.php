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
					{!! Form::open(['route' => 'admin.store', 'class' => 'form-horizontal panel']) !!}	
					<div class="form-group">
                        {!!Form::label('managerName','Select Participant')!!}
						{!! Form::select('name', $users,null, ['class'=> 'form-control','id'=>'managerName'])  !!}
					</div>
					
					<div class="form-group">
                        
						{!! Form::hidden('id', $proj_id)  !!}
					</div>
                   
					</div>
					{!! Form::submit('Send', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Back
		</a>


@endsection