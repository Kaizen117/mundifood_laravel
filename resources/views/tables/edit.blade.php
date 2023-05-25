<head>
    <link rel="stylesheet" href="{{ asset('css/editblade.css')}}">
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fas fa-edit"></i> Editar mesa</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ url('/tables/edit/'.$table->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('diner_number') ? ' has-error' : '' }}">
                            <label for="diner_number" class="col-md-4 control-label">Número de comensales:</label>

                            <div class="col-md-2">
                                <input id="diner_number" type="number" class="form-control" name="diner_number" value="{{ $table->diner_number }}" min="1" max="10" autofocus>

                                @if ($errors->has('diner_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('diner_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                            <label for="place" class="col-md-4 control-label">Lugar:</label>

                            <div class="col-md-6">
                                <select id="place" class="form-select form-select-lg" name="place">
                                    <option value="Comedor" {{ $table->place == 'Comedor' ? 'selected' : '' }}>Comedor principal</option>
                                    <option value="Salón" {{ $table->place == 'Salón' ? 'selected' : '' }}>Salón</option>
                                    <option value="Terraza" {{ $table->place == 'Terraza' ? 'selected' : '' }}>Terraza</option>
                                </select>
                                @if ($errors->has('place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('place') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar mesa
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
