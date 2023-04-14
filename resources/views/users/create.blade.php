<head>
    <link rel="stylesheet" href={{ asset('css/dishes.css')}}>
    
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {            
            $('#roles').on('change', function(){
                var role=$(this).find(':selected').val();
                console.log(role);
                /*var data1=$('select option').filter(':selected').val(); 
                console.log(data1);
                $('#select1').val(data1);
                console.log('Changed option value ' + this.value);              */
            });
            
            $('#activated').on('change', function () {                
                var active=$(this).find(':selected').val();
                console.log(active);                
            });
                
        });
    </script>-->
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear nuevo usuario</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/users/confirm') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname1') ? ' has-error' : '' }}">
                            <label for="surname1" class="col-md-4 control-label">Primer apellido</label>

                            <div class="col-md-6">
                                <input id="surname1" type="text" class="form-control" name="surname1" value="{{ old('surname1') }}" required>

                                @if ($errors->has('surname1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname2') ? ' has-error' : '' }}">
                            <label for="surname2" class="col-md-4 control-label">Segundo apellido</label>

                            <div class="col-md-6">
                                <input id="surname2" type="text" class="form-control" name="surname2" value="{{ old('surname2') }}" required>

                                @if ($errors->has('surname2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <label for="telephone" class="col-md-4 control-label">Teléfono</label>

                            <div class="col-md-2">
                                <input id="telephone" type="tel" class="form-control" name="telephone" maxlength="9" value="{{ old('telephone') }}" placeholder="123012345" pattern="[0-9]{9}" required>

                                @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Dirección</label>

                            <div class="col-md-6">
                                <input id="text" type="tel" class="form-control" name="address" value="{{ old('address') }}" required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" minlength="6" maxlength="50" placeholder="a@a.com" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Nombre de usuario</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                      
                        
                        <div class="form-group">
                            <label for="password_confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirm" required>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Rol</label>

                            <div class="col-md-6">
                                <select name="type" id="type" class="form-select form-select-lg mb-3" required>
                                    <option value="users" selected>Usuario</option>
                                    <option value="waiters">Camarero</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group{{ $errors->has('activated') ? ' has-error' : '' }}">
                            <label for="activated" class="col-md-4 control-label">Activado</label>

                            <div class="col-md-6">
                                <select name="activated" id="activated" class="form-select form-select-lg mb-3" required>
                                    <option value="0" selected>Desactivar</option>
                                    <option value="1">Activar</option>
                                </select>
                                @if ($errors->has('activated'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activated') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                    
                        
                        <!--<input id="type" type="text" class="form-control" name="type" required>
                        <input id="activated" type="text" class="form-control" name="activated" required>-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Agregar nuevo usuario
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