<head>
    <link rel="stylesheet" href="{{ asset('css/addblade.css')}}">
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><i class="fas fa-clock"> Insertar nueva reserva</i></h4></div>
                <br/>
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
                    
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ url('/reserves/confirm') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label for="user_id" class="col-md-4 control-label">Propietario de la reserva</label>

                            <div class="col-md-4">
                                <select id="user_id" class="form-control" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname1 }} {{ $user->surname2 }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('diner_number') ? ' has-error' : '' }}">
                            <label for="diner_number" class="col-md-4 control-label">Número de comensales:</label>

                            <div class="col-md-2">
                                <input id="diner_number" type="number" class="form-control" name="diner_number" value="{{ old('diner_number') }}" min="1" max="10" required>
                                
                                @if ($errors->has('diner_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('diner_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                                               
                        <div class="form-group{{ $errors->has('table_id') ? ' has-error' : '' }}">
                            <label for="table_id" class="col-md-4 control-label">Mesa a reservar:</label>
                            <div class="col-md-6">
                                <select id="table_id" class="form-select form-select-lg" name="table_id" onchange="updateSelectedPlace(this)">
                                    <option value="">-</option>
                                    @foreach($availableTables as $table)
                                        <option value="{{ $table->id }}">Mesa {{ $table->table_number }} - {{ $table->place }} - Nº de comensales: {{ $table->diner_number }}</option>
                                    @endforeach
                                </select>
        
                                @if ($table->diner_number < count($selectedUsers))
                                    <p class="text-danger">No hay espacio suficiente para dichos comensales.</p>
                                @endif                               

                                @if ($table->place=="")
                                    <p class="text-danger">Debe seleccionar una mesa.</p>
                                @endif

                                @if ($errors->has('table_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('table_id') }}</strong>
                                    </span>
                                @endif                                
                            </div>                                                                                            
                        </div>
                        
                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Fecha de la reserva</label>

                            <div class="col-md-4">
                                <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}" required>
                                
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hour') ? ' has-error' : '' }}">
                            <label for="hour" class="col-md-4 control-label">Hora de la reserva</label>

                            <div class="col-md-4">
                                <select name="hour" id="hour" class="form-select form-select-lg mb-3" required>
                                    <optgroup label="Tarde">
                                        <option value="13:00">13:00 PM</option>
                                        <option value="14:00">14:00 PM</option>
                                        <option value="15:00">15:00 PM</option>
                                    </optgroup>
                                    <optgroup label="Noche">
                                        <option value="20:00">20:00 PM</option>
                                        <option value="21:00">21:00 PM</option>
                                        <option value="22:00">22:00 PM</option>
                                    </optgroup>
                                </select>

                                @if ($errors->has('hour'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hour') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('observations') ? ' has-error' : '' }}">
                            <label for="observations" class="col-md-4 control-label">Observaciones</label>

                            <div class="col-md-8">                                
                                <input id="observations" class="form-control" name="observations" placeholder="Nº adultos, nº niños, alérgenos..." value="{{ old('observations') }}" maxlength="50" required></input>

                                @if ($errors->has('observations'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('observations') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Crear reserva
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