<head>
    <link rel="stylesheet" href="{{ asset('css/indexCrud.css') }}">
</head>

@extends('layouts.app')
@section('content')
    <div class="row">        
        <div class="container">                               
            <div class="col-md-15">            
                <h1 class="text-center text-mute">{{ __("Mesas") }}</h1>
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
                    
                <a class="btn btn-primary" role="button" href="/tables/new">Añadir nueva mesa</a>
                <p id="contPages">Mostrando <span id="cant">10</span> mesas por página ordenados por número de mesa.</p>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr><br/><br/>
                                <th scope="col">Nº de mesa</th>
                                <th scope="col">Nº de comensales</th>
                                <th scope="col">Lugar</th>
                                <th scope="col">Fecha de incorporación</th>
                                <th scope="col">Fecha de modificación</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        @forelse($tables as $table)
                            <tbody>
                                <tr>
                                    <td>{{ $table->table_number }}</td>
                                    <td>{{ $table->diner_number }}</td>
                                    <td>{{ $table->place }}</td>
                                    <td>{{ $table->created_at }}</td>
                                    <td>{{ $table->updated_at }}</td>
                                    <td>
                                        <a class="btn btn-primary" id="editar" href="{{ url('/tables/edit/' . $table->id) }}" title="Editar mesa"><i class="fas fa-edit"></i> Editar</a>
                                        <a class="btn btn-danger" id="eliminar" title="ELIMINAR MESA" data-toggle="modal" data-target="#exampleModal-{{$table->id}}"><i class="fas fa-trash-alt"></i> Eliminar</a>                      
                                        <div class="modal fade" id="exampleModal-{{$table->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Mesa</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar la mesa {{$table->id}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-danger" href="{{ url('/tables/delete/' . $table->id) }}">Borrar</i></a>
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
                            <div class="alert alert-danger">
                                {{ __("No hay ninguna mesa") }}
                            </div>  
                        @endforelse
                    </table>
                    
                <div class="text-center">
                    @if($tables->count())
                        {{ $tables->links() }}
                    @endif
                </div>                
            </div>
        </div>
    </div>
    @include('footer')
@endsection