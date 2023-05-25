<head>
    <link rel="stylesheet" href="{{ asset('css/addblade.css')}}">
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Crear nuevo plato</h4></div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ url('/dishes/confirm') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="50" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Imagen</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" maxlength="255" required>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Precio</label>

                            <div class="col-md-2">
                                <input id="price" type="number" class="form-control" name="price" step="any" min="1" max="999" value="{{ old('price') }}" required>

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Descripción</label>

                            <div class="col-md-6">                                
                                <textarea id="description" class="form-control" name="description" placeholder="Descripción del plato (origen, país...)" value="{{ old('description') }}" cols=20 rows=5 maxlength=225 required></textarea>
                                
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Categoría</label>
                            
                            <div class="col-md-6">
                                <!--<input id="text" type="text" class="form-control" name="category" value="{{ old('category') }}" maxlength="20" required>-->
                                <select name="category" id="category" class="form-select form-select-lg mb-3" required>
                                    <option value="Otros" selected>Otros</option>
                                    <option value="Entrantes">Entrantes</option>
                                    <option value="Sopas">Sopas</option>
                                    <option value="Carnes">Carnes</option>
                                    <option value="Pescados">Pescados</option>
                                    <option value="Bebidas">Bebidas</option>
                                    <option value="Postres">Postres</option>
                                    <option value="Vinos">Vinos</option>
                                </select>
                              
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('disponibility') ? ' has-error' : '' }}">
                            <label for="disponibility" class="col-md-4 control-label">Disponibilidad</label>

                            <div class="col-md-6">
                                <select id="disponibility" class="form-select form-select-lg" name="disponibility" required>
                                    <option value="1" selected>Disponible</option>
                                    <option value="0">No disponible</option>
                                </select>
                                
                                @if ($errors->has('disponibility'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('disponibility') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Agregar nuevo plato
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection