<head>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar usuario</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{  url('/users/confirm') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" maxlength="25" required autofocus>

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
                                <input id="surname1" type="text" class="form-control" name="surname1" value="{{ $user->surname1 }}" maxlength="30" required autofocus>

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
                                <input id="surname2" type="text" class="form-control" name="surname2" value="{{ $user->surname2 }}" maxlength="30" required autofocus>

                                @if ($errors->has('surname2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <label for="telephone" class="col-md-4 control-label">Teléfono</label>

                            <div class="col-md-6">
                                <input id="telephone" type="tel" class="form-control" name="telephone" maxlength="9" value="{{ $user->telephone }}" pattern="[0-9]{9}" required autofocus>

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
                                <input id="text" type="tel" class="form-control" name="address" value="{{ $user->address }}" maxlength="150" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" minlength="6" maxlength="50" placeholder="a@a.com" required>

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
                                <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" maxlength="30" required>

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
                                <input id="password" type="password" class="form-control" name="password" value="{{ $user->password }}" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('c_password') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                @if ($errors->has('c_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('c_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>            

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Rol</label>

                            <div class="col-md-6">
                                <select id="roles" class="form-select form-select-lg" name="{{$user->type}}" required>
                                    <option value="{{ $user->type }}">Usuario</option>
                                    <option value="{{ $user->type }}">Camarero</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('activated') ? ' has-error' : '' }}">
                            <label for="activated" class="col-md-4 control-label">Activar usuario</label>

                            <div class="col-md-6">
                                <select id="activated" class="form-select form-select-lg" name="select2" required>
                                    <option value="{{ $user->activated }}">Activar</option>
                                    <option value="{{ $user->activated }}">Desactivar</option>
                                </select>
                                @if ($errors->has('activated'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activated') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar usuario
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
