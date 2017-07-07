@extends('user-template')

@section('contenu')


<br>
    <div class="col-sm-offset-3 col-sm-6">
    	@if(session()->has('ok'))
			<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
		@endif
        
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
					@foreach ($reports as $report)
						<tr>
							<td>{!! $report->id !!}</td>
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
		{!! $links !!}
	</div>



@endsection