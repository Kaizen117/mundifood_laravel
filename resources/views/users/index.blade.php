<head>
    <link rel="stylesheet" href="{{ asset('css/indexCrud.css') }}">
</head>

@extends('layouts.app')
@section('content')
    <div class="row">        
        <div class="container">                               
            <div class="col-md-15">
                <h1 class="text-center text-mute">{{ __("Usuarios") }}</h1>
                <br/>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('info'))
                    <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        Ocurrió un error inesperado.
                    </div>
                @endif

                <a class="btn btn-success" role="button" href="/users/new">Crear nuevo camarero</a>
                <p id="contPages">Mostrando <span id="cant">10</span> usuarios por página ordenados por registro reciente.</p>
                <form action="{{ route('sendEmail') }}" method="POST">
                     {{ csrf_field() }}                   
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido1</th>
                                <th scope="col">Apellido2</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Correo electrónico</th>
                                <th scope="col">Nombre de Usuario</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Activado</th>
                                <th scope="col">¿Enviar correo?</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>                                                     
                        @forelse($users as $user)              
                            <tbody>
                                <tr>                                  
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->surname1 }}</td>
                                    <td>{{ $user->surname2 }}</td>
                                    <td>{{ $user->telephone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->email }}</td>                            
                                    <td>{{ $user->username }}</td>                               
                                    <td>@if($user->type === "users")
                                            Usuario
                                        @else
                                            Camarero
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->activated == 1)
                                            <!--<input type="checkbox" checked disabled>-->
                                            <span class="green-tick">✔️ Sí</span> 
                                        @else
                                            <!--<input type="checkbox" disabled>-->
                                            <span class="red-denied">❌ No</span>
                                        @endif                                       
                                    </td>
                                    <td><input type="checkbox" name="marcado[]" value="{{ $user->email }}"/></td>
                                    <td>
                                        <a class="btn btn-primary" id="editar" href="{{ url('/users/edit/' . $user->id) }}" title="Editar este usuario"><i class="fas fa-edit"></i> Editar</a>
                                        <!--<a class="btn btn-danger" id="eliminar" href="{{ url('/users/delete/' . $user->id) }}" title="ELIMINAR USUARIO" onclick="return confirm('Estas apunto de eliminar el usuario marcado')"><i class="fas fa-trash-alt"></i> Eliminar</a>-->
                                        <a class="btn btn-danger" id="eliminar" title="ELIMINAR USUARIO" data-toggle="modal" data-target="#exampleModal-{{$user->id}}"><i class="fas fa-trash-alt"></i> Eliminar</a>                      
                                        <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar al usuario {{$user->username}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-danger" href="{{ url('/users/delete/' . $user->id) }}">Borrar</i></a>
                                                        <a data-dismiss="modal" class="btn btn-primary">Cancelar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>                              
                            </tbody>                           
                        @empty
                            <br/>
                            <div class="alert alert-danger"></div>
                                {{ __("No hay ningún usuario") }}
                            </div>  
                        @endforelse                         
                    </table>
                    <div class="col-md-15">
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <h4><i class="fas fa-envelope"></i> Newsletter</h4>
                                <label class="form-control">Asunto: <input type="text" name="asunto" size="130px" required><br/></label> 
                                <textarea class="form-control" name="contenido" placeholder="Cuerpo del email. Recuerda que el texto introducido se añadirá a la plantilla programada: " cols=154 rows=10 required></textarea><br/>
                                <input class="form-control" id="send" type="submit" value="Enviar emails a los usuarios seleccionados de la página actual">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    @if($users->count())
                        {{ $users->links() }}
                    @endif
                </div>

            </div>
        </div>
    </div>
    @include('footer')
@endsection