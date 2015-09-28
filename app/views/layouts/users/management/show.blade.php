@extends ('layouts.master')

@section ('title') Usuario: {{ $user->username.' #'.$user->id }} @stop

@section('content')
          <div class="col-lg-12">            

            <p><b>Nombre de Usuario:</b> {{ $user->username }}</p>
            <p><b>Correo Electrónico:</b> {{ $user->email }}</p>

            <p>
              <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Editar</a>    
            </p>

            {{ Form::model($user, array('route' => array('admin.users.destroy', $user->id), 'method' => 'DELETE'), array('role' => 'form')) }}
            {{ Form::submit('Eliminar usuario', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}            
          </div>  
  
@stop