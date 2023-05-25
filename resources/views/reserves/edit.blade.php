<head>
    <link rel="stylesheet" href="{{ asset('css/editblade.css')}}">
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fas fa-edit"></i> Editar reserva</div>
                <br/>
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ url('/reserves/edit/'.$reserve->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('diner_number') ? ' has-error' : '' }}">
                            <label for="diner_number" class="col-md-4 control-label">Número de comensales</label>

                            <div class="col-md-2">
                                <input id="diner_number" type="number" class="form-control" name="diner_number" value="{{ $reserve->diner_number }}" min="1" max="10" autofocus>

                                @if ($errors->has('diner_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('diner_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Fecha de la reserva</label>

                            <div class="col-md-4">
                                <input id="date" type="date" class="form-control" name="date" value="{{ $reserve->date }}">
                                
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
                                <select name="hour" id="hour" class="form-select form-select-lg mb-3">
                                    <optgroup label="Tarde">
                                        <option value="13:00" {{ $reserve->hour == '13:00:00' ? 'selected' : '' }}>13:00 PM</option>
                                        <option value="14:00" {{ $reserve->hour == '14:00:00' ? 'selected' : '' }}>14:00 PM</option>
                                        <option value="15:00" {{ $reserve->hour == '15:00:00' ? 'selected' : '' }}>15:00 PM</option>
                                    </optgroup>
                                    <optgroup label="Noche">
                                        <option value="20:00" {{ $reserve->hour == '20:00:00' ? 'selected' : '' }}>20:00 PM</option>
                                        <option value="21:00" {{ $reserve->hour == '21:00:00' ? 'selected' : '' }}>21:00 PM</option>
                                        <option value="22:00" {{ $reserve->hour == '22:00:00' ? 'selected' : '' }}>22:00 PM</option>
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

                            <div class="col-md-6">                                
                                <input id="observations" class="form-control" name="observations" placeholder="Nº adultos, nº niños, alérgenos..." value="{{ $reserve->observations }}" maxlength="50"></input>

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
                                    Actualizar reserva
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
