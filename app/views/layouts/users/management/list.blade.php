@extends ('layouts.master')

@section ('title') Lista de Usuarios @stop

@section('content')

          <div class="col-lg-12">    
            <table id="listUsers" class="table table-striped table-hover">
            <tr>
              <th>#</th>
              <th>Nombre de Usuario</th>
              <th>Correo Electrónico</th>
              <th>Acciones</th>
            </tr>
            @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <a href="{{ route('admin.users.show', $user->id) }}"><button class="btn btn-info">Ver</button></a>
                <a href="{{ route('admin.users.edit', $user->id) }}"><button class="btn btn-primary">Editar</button></a>
                <button id="{{ $user->id }}" class="btn btn-danger btn-delete">Eliminar</button>
              </td>
            </tr>
            @endforeach
            </table>
            {{ $users->links() }}
            {{ Form::open(array('route' => array('admin.users.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'formDeleteUser')) }}
            {{ Form::close() }}
            {{ HTML::script('assets/js/users/management.delete.js') }}             
          </div>
@stop