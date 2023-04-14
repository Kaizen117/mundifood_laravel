@extends('layouts.app')
@section('content')
    <div class="row">        
        <div class="container">                               
            <div class="col-md-15">
                <!-- <a href="{{ url('/') }}" class="btn btn-link">Volver al index</a> -->
                <h1 class="text-center text-mute"><u> {{ __("Usuarios") }} </u></h1>
                <br/>

                <!--@if(session('message'))
                    <div class="alert alert-{{ session('message')[0] }}">
                        {{ session('message')[1] }}
                    </div>
                @endif-->

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

                <a class="btn btn-success" role="button" href="/users/new">Crear nuevo usuario</a>
                <span style="float: right;">Mostrando <b>10</b> usuarios por página.</span>
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
                                <th scope="col">Usuario</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Activación</th>
                                <th scope="col">¿Enviar newsletter?</th>
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
                                    <td>{{ $user->type }}</td>
                                    <td>{{ $user->activated }}</td>                                   
                                    <td><input type="checkbox" name="marcado[]" value="{{$user->email}}"></td>
                                    <td><a class="btn btn-primary" href="{{ url('/users/edit/' . $user->id) }}" title="Editar este usuario"><i class="fas fa-edit"></i> Editar</a></td>
                                    <td><a class="btn btn-danger" href="{{ url('/users/delete/' . $user->id) }}" title="ELIMINAR USUARIO" onclick="return confirm('Estas apunto de eliminar el usuario marcado')"><i class="fas fa-trash-alt"></i> Eliminar</a></td>
                                </tr>                              
                            </tbody>                           
                        @empty
                            <div class="alert alert-danger"></div>
                                {{ __("No hay ningún usuario") }}
                            </div>  
                        @endforelse                         
                    </table>
                    <div class="col-md-15">
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <h4><i class="fas fa-envelope"></i> Newsletter</h4>
                                <label class="form-control">Asunto: <input type="text" name="asunto" style="border: none;" size="130px" required><br/></label> 
                                <textarea class="form-control" name="contenido" placeholder="Cuerpo del email" cols=154 rows=10 required></textarea><br/>
                                <input class="form-control" type="submit" value="Enviar emails seleccionados de la página actual">
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