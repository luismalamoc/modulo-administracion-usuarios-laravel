@extends ('layouts.master')

@section ('title') {{ $action }} Usuarios @stop

@section('content')

    <div class="col-lg-12">
            @if ($action == 'Editar')  
              {{ Form::model($user, array('route' => array('admin.users.destroy', $user->id), 'method' => 'DELETE', 'role' => 'form')) }}
              <div class="row">
                <div class="form-group col-md-4">
                  {{ Form::submit('Eliminar Usuario', array('class' => 'btn btn-danger')) }}
                </div>
              </div>
              {{ Form::close() }}
            @endif

            {{ Form::model($user, $form_data, array('role' => 'form')) }}

            <div class="row">
              <div class="form-group col-md-4">
                {{ Form::label('username', 'Nombre de Usuario') }}
                {{ Form::text('username', null, array('placeholder' => 'Introduce el Nombre de Usuario', 'class' => 'form-control')) }}
              </div>
              <div class="form-group col-md-4">
                {{ Form::label('email', 'Dirección de Correo Electrónico') }}
                {{ Form::text('email', null, array('placeholder' => 'Introduce el Correo Electrónico', 'class' => 'form-control')) }}
              </div>
              <div class="form-group col-md-4">
                {{ Form::label('name', 'Nombres ') }}
                {{ Form::text('name', null, array('placeholder' => 'Introduce los nombres', 'class' => 'form-control')) }}        
              </div>
              <div class="form-group col-md-4">
                {{ Form::label('lastname', 'Apellidos') }}
                {{ Form::text('lastname', null, array('placeholder' => 'Introduce los apellidos', 'class' => 'form-control')) }}        
              </div>                            
            </div>

            <div class="row">
              <div class="form-group col-md-4">
                {{ Form::label('password', 'Contraseña') }}
                {{ Form::password('password', array('class' => 'form-control')) }}
              </div>
              <div class="form-group col-md-4">
                {{ Form::label('password_confirmation', 'Confirmar contraseña') }}
                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
              </div>  
            </div> 
          {{ Form::button($action.' Usuario', array('type' => 'submit', 'class' => 'btn btn-success')) }}    
  
          {{ Form::close() }}            
    </div>             
 
@stop