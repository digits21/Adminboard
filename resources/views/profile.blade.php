@extends('single-content')

@section('content')
    <div class="col-sm-offset-2 col-sm-8">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">About user</div>
			<div class="panel-body"> 
				<p>Name : {{ $user->name }}</p>
				<p>Email : {{ $user->email }}</p>
				@if($user->admin == 1)
					Administrator
				@endif
			</div>
            
            
            
		</div>
        {!! link_to_route('user.edit', 'Edit', [$user->id], ['class' => 'btn btn-warning btn-block pull-right']) !!}
        <br><br><br>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Back
		</a>
	</div>
@endsection
