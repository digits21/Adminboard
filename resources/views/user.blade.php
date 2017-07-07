@extends('user-template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
    	@if(session()->has('ok'))
			<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
		@endif
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
						<th></th>
                                                <th>Reports</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>{!! $user->id !!}</td>
							<td class="text-primary"><strong>{!! $user->name !!}</strong></td>
							<td>{!! link_to_route('user.show', 'See more', [$user->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! link_to_route('user.edit', 'Edit', [$user->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Do you really want to delete this user ?\')']) !!}
								{!! Form::close() !!}
							</td>
                            <td> 
                            {!!link_to_route('admin.show', 'See Reports',[$user->id],['class'=>'btn btn-primary'])!!}
                            
                            </td>
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		{!! link_to_route('user.create', 'Add a user', [], ['class' => 'btn btn-info pull-right']) !!}
		{!! $links !!}
	</div>
@endsection

