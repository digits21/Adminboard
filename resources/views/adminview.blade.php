@extends('admin-template')


@section('content-left')

<!---/Reports-->
<br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Reports of {{$user->name}}</h3>
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
		
		{!! $self_reports_pages !!}

@endsection


@section('content-right')
<br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Active Projects of {{$user->name}}</h3>
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
		
		{!! $self_projects_pages!!}

<!--Closed projects-->

<br><br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Closed Projects of {{$user->name}}</h3>
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

<br><br><br><br>
    
    	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Managing Projects of {{$user->name}}</h3>
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
					@foreach ($manage_project as $project)
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
		
		{!! $manage_links !!}

<!--Maning Projects End -->


@endsection



