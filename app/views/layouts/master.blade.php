<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">   
    <title> @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ HTML::style('assets/css/bootstrap.min.css', array('media' => 'screen')) }}
    {{ HTML::style('assets/css/jumbotron-narrow.css', array('media' => 'screen')) }}     
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      {{ HTML::script('assets/js/html5shiv.min.js') }}
      {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->
    {{ HTML::script('assets/js/jquery.min.js') }}
  </head>
  <body>
	<div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="{{ route('admin.users.index') }}">Listar</a></li>
          <li><a href="{{ route('admin.users.create') }}">Crear</a></li>          
        </ul>
        <h3 class="text-muted">Módulo de Usuarios</h3>
      </div>

      <div class="row">
		
		<div class="col-lg-12">
			
			 @if(Session::has('error'))
                <div class="alert alert-dismissable alert-danger">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>{{ Session::get('error') }}</strong>
                </div>
              @endif

              @if(Session::has('success'))
                <div class="alert alert-dismissable alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>{{ Session::get('success') }}</strong>
                </div>
              @endif

              @if(Session::has('info'))
                <div class="alert alert-dismissable alert-info">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>{{ Session::get('info') }}</strong>
                </div>
              @endif

              @if(Session::has('warning'))
                <div class="alert alert-dismissable alert-warning">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>{{ Session::get('warning') }}</strong>
                </div>
              @endif
			
			@include ('layouts.errors', array('errors' => $errors))
			
		</div>
		
		@yield('content')
        
      </div>

      <div class="footer">
        <p>Powered by Luis Álamo &copy;Copyleft</p>
      </div>

    </div> 
	{{ HTML::script('assets/js/bootstrap.min.js') }}
  </body>  
</html>