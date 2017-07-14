<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Sanlien 科技</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        {!!Html::style('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css')!!}
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="/css/styles.css" rel="stylesheet">
	</head>
	<body>
<!-- header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Sanlien 科技</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> {{Auth::user()->name}} <span class="caret"></span></a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <li><a href="#">My Profile</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="glyphicon glyphicon-lock">
                    </i> Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                </form>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <!-- Left column -->
            @if(Auth::user()->admin==1)
            <a href="{{url('admin_dashboard')}}"><strong><i class="glyphicon glyphicon-tasks"></i>Menu</strong></a>
            @else
            <a href="{{url('user_dashboard')}}"><strong><i class="glyphicon glyphicon-tasks"></i>Menu</strong></a>
            @endif
            <hr>

            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">Pojects <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav nav-stacked collapse in" id="userMenu">
                        <li class="active"> <a href="{{url('projects')}}"><i class="glyphicon glyphicon-home"></i>All</a></li>
                        
                        <li><a href="{{url('create_project')}}"><i class="glyphicon glyphicon-plus"></i> Add</a></li>
                        
                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"> Reports <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu2">
                        
                        <li><a href="{{url('user_reports')}}"><i class="glyphicon glyphicon-home"></i> All</a>
                        </li>
                        <li><a href="{{url('chat')}}"><i class="glyphicon glyphicon-plus"></i> Add</a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-header">
                    <a href="{{url('profile')}}" data-toggle="collapse" data-target="#menu3">Profile<i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu3">
                        <li><a href="{{url('profile')}}"><i class="glyphicon glyphicon-cog"></i>My profile</a></li>
                        @if(Auth::user()->admin==1)
                        <li><a href="{{url('create')}}"><i class="glyphicon glyphicon-user"></i>Add user</a></li>
                        @endif
                    </ul>
                </li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="glyphicon glyphicon-lock">
                    </i> Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                </form>
            </ul>

            
            
        </div>
        <!-- /col-3 -->
        <div class="col-sm-9">

            <!-- column 2 -->
            <ul class="list-inline pull-right">
                
                
                
                <li><a title="Add Widget" href="{{url('create_project')}}"><span class="glyphicon glyphicon-plus-sign"></span> Add Project</a></li>
            </ul>
            @if(Auth::user()->admin==1)
            <a href="{{url('admin_dashboard')}}"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
            @else
               <a href="{{url('user_dashboard')}}"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
            @endif
            <hr>

            <div class="row">
                <!-- center left-->
                <div class="col-sm-offset-2 col-sm-8">

                    

                    

                    <div class="btn-group btn-group-justified">
                        <a href="{{url('create_project')}}" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-plus"></i>
                            <br> Project
                        </a>
                        <a href="{{url('chat')}}" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-plus"></i>
                            <br> Report
                        </a>
                        @if(Auth::user()->admin==1)
                        <a href="{{url('create')}}" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-plus"></i>
                            <br> User
                        </a>
                        @endif
                        
                        
                    </div>
                </div>
                <br>
                
                    
                    @yield('content')
                    

                    
                    
                
                

            </div>
            <!--/row-->

            

            

            

            
        </div>
        <!--/col-span-9-->
    </div>
</div>
<!-- /Main -->

<footer class="text-center">&copy;2017 SAN LIEN TECHNOLOGY CORP. All Rights Reserved. <a href="http://www.sanlien.com/web/homepage.nsf/sanlien-index?openform"><strong></strong></a></footer>


<!-- /.modal -->
	<!-- script references -->
		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>-->
		<script src="/js/scripts.js"></script>
         <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
    
    
    $('#summernote').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
  </script>
	</body>
</html>