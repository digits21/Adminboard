@extends('single-content')

@section('content')
    <div class="col-sm-12">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading text-center">{{$report->title}}</div>
			<div class="panel-body"> 
				@if($report->image!=NULL)
					<img src="{{asset('images/'.$report->image)}}">
				@endif
                {!!$report->description!!}
				
			</div>
		</div>				
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Back
		</a>
	</div>
@endsection
