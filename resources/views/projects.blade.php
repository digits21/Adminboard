@extends('projects-template')


@section('content-left')
  
      @foreach($project as $val)
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading text-center">{{$val->project_name}}</div>
			<div class="panel-body"> 
				
                {!!$val->content!!}
				
			</div>
            
		</div>				
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Back
		</a>
	
@endforeach

@endsection


@section('content-right')

@foreach($project as $val)
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading text-center">About Creator and Manager</div>
			<div class="panel-body"> 
				
                <span> Creator :{!!$val->name!!}</span>
                <br><br>
                @foreach($manager as $man)
                <span> Manager :{!!$man->name!!}</span>
                @endforeach
				
			</div>
		</div>	
     <!--- participants-->
       <div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">All the Participants</h3>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th></th>
						<th></th>
						<th></th>
                    <th>Dashboard</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>{!! $user->id !!}</td>
							<td class="text-primary"><strong>{!! $user->name !!}</strong></td>
                            
							<td>{!! link_to_route('user.show', 'See more', [$user->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td></td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['admin.destroy', $user->id]]) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Do you really want to delete this user ?\')']) !!}
								{!! Form::close() !!}
							</td>
                            <td> 
                            {!!link_to_route('admin.show', 'dashboard',[$user->id],['class'=>'btn btn-primary'])!!}
                            
                            </td>
                            
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		{!! link_to_route('admin.edit', 'Add a user', [$id], ['class' => 'btn btn-info pull-right']) !!}
		{!! $links !!}
	
<!--- participants end -->
		
	
@endforeach


@endsection