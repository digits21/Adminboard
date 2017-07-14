@extends('admin-template')


@section('content-left')
<br><br><br>
<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">All the users</h3>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th></th>
						<th></th>
						
                    <th>Reports</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>{!! $user->id !!}</td>
							<td class="text-primary"><strong>{!! $user->name !!}</strong></td>
							
							<td>{!! link_to_route('user.edit', 'Edit', [$user->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
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
		{!! link_to_route('user.create', 'Add a user', [], ['class' => 'btn btn-info pull-right']) !!}
		{!! $links !!}
<!---/Reports-->
<br><br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Reports of {{Auth::user()->name}}</h3>
			</div>
            
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th></th>
						<th></th>
						<th></th>
                                                
					</tr>
				</thead>
				<tbody>
					@foreach ($self_reports as $report)
						<tr>
							<td>{!! $report->created_at !!}</td>
							<td class="text-primary"><strong>{!! $report->title !!}</strong></td>
							<td>{!! link_to_route('post.show', 'See report', [$report->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! link_to_route('post.edit', 'Edit', [$report->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['post.destroy', $report->id]]) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Do you really want to delete this report ?\')']) !!}
								{!! Form::close() !!}
							</td>
                            
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		{!! link_to_route('post.create', 'Add a  report', [], ['class' => 'btn btn-info pull-right']) !!}
		{!! $self_reports_pages !!}


<!---Participating Project-->
<br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">  Projects Which {{Auth::user()->name}} Contributes</h3>
			</div>
            
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Project Code</th>
						<th></th>
						<th></th>
						<th></th>
                                                
					</tr>
				</thead>
				<tbody>
					@foreach ($participates_projects as $project)
						<tr>
							<td>{!! $project->created_at !!}</td>
							<td class="text-primary"><strong>{!! $project->code !!}</strong></td>
							<td>{!! link_to_route('projects.show', 'See Project', [$project->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! link_to_route('projects.edit', 'Edit', [$project->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]) !!}
									{!! Form::submit('Close', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Do you really want to close this project ?\')']) !!}
								{!! Form::close() !!}
							</td>
                            
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		
		{!! $participate_links !!}

<!--- Participating project end -->



@endsection


@section('content-right')
<br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Active Projects of {{Auth::user()->name}}</h3>
			</div>
            
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Project Code</th>
						<th></th>
						<th></th>
						<th></th>
                                                
					</tr>
				</thead>
				<tbody>
					@foreach ($self_projects as $project)
						<tr>
							<td>{!! $project->created_at !!}</td>
							<td class="text-primary"><strong>{!! $project->code !!}</strong></td>
							<td>{!! link_to_route('projects.show', 'See Project', [$project->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! link_to_route('projects.edit', 'Edit', [$project->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]) !!}
									{!! Form::submit('Close', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Do you really want to close this project ?\')']) !!}
								{!! Form::close() !!}
							</td>
                            
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		{!! link_to_route('projects.create', 'Add a  project', [], ['class' => 'btn btn-info pull-right']) !!}
		{!! $self_projects_pages!!}

<!--Closed projects-->

<br><br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Closed Projects of {{Auth::user()->name}}</h3>
			</div>
            
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Project Code</th>
						<th></th>
						<th></th>
						<th></th>
                                                
					</tr>
				</thead>
				<tbody>
					@foreach ($Closed_projects as $project)
						<tr>
							<td>{!! $project->created_at !!}</td>
							<td class="text-primary"><strong>{!! $project->code !!}</strong></td>
							<td>{!! link_to_route('projects.show', 'See Project', [$project->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! link_to_route('projects.edit', 'Edit', [$project->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								<a href="#" class="btn btn-danger" role="button" disabled> Closed</a>
							</td>
                            
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		
		{!! $projects_pages !!}


<!-- Closed projects end -->

<!-- Managing projects -->

<br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Managing Projects of {{Auth::user()->name}}</h3>
			</div>
            
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Project Code</th>
						<th></th>
						<th></th>
						<th></th>
                                                
					</tr>
				</thead>
				<tbody>
					@foreach ($manage_project as $project_man)
                     @if($project_man->status==1)
						<tr>
							<td>{!! $project->created_at !!}</td>
							<td class="text-primary"><strong>{!! $project_man->code !!}</strong></td>
							<td>{!! link_to_route('projects.show', 'See Project', [$project_man->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! link_to_route('projects.edit', 'Edit', [$project_man->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project_man->id]]) !!}
									{!! Form::submit('Close', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Do you really want to close this project ?\')']) !!}
								{!! Form::close() !!}
							</td>
                            
						</tr>
                    @endif
					@endforeach
	  			</tbody>
			</table>
		</div>
		
		{!! $manage_links !!}

<!--Maning Projects End -->





@endsection



