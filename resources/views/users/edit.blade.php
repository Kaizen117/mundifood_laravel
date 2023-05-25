<head>
    <link rel="stylesheet" href="{{ asset('css/editblade.css')}}">
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user" aria-hidden="true"></i> Editar usuario
                </div>
                               
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/users/edit/'.$user->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ route('users.edit-password', ['id' => $user->id]) }}" class="btn btn-primary">Resetear contraseña</a>
                            </div>
                        </div>                        

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" minlength="1" maxlength="25" pattern="([A-zÀ-ž\s]){1,25}" oninvalid="this.setCustomValidity('Por favor, introduzca solo letras (admite nombre compuesto, mayúsculas y minúsculas).')" onchange="this.setCustomValidity('')" autofocus>

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
                                <input id="surname1" type="text" class="form-control" name="surname1" value="{{ old('surname1', $user->surname1) }}" minlength="1" maxlength="30" pattern="([A-zÀ-ž\s]){1,30}" oninvalid="setCustomValidity(this.willValidate?'':'Por favor introduzca solo letras.')" onchange="this.setCustomValidity('')">

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
                                <input id="surname2" type="text" class="form-control" name="surname2" value="{{ old('surname2', $user->surname2) }}" minlength="1" maxlength="30" pattern="([A-zÀ-ž\s]){1,30}" oninvalid="setCustomValidity(this.willValidate?'':'Por favor introduzca solo letras.')" onchange="this.setCustomValidity('')">

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
                                <input id="telephone" type="tel" class="form-control" name="telephone" maxlength="9" value="{{ old('telephone', $user->telephone) }}" pattern="[0-9]{9}" oninvalid="setCustomValidity(this.willValidate?'':'Por favor introduzca solo números.')" onchange="this.setCustomValidity('')">
                                
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
                                <input id="text" type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}" minlength="1" maxlength="150" pattern="[A-Za-z0-9'\.\-\s\,]{1,150}">

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" minlength="6" maxlength="50" placeholder="a@a.com">
                                
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
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" maxlength="30" pattern="[A-Za-z0-9\-_\.]{1,30}" oninvalid="setCustomValidity(this.willValidate?'':'Por favor introduzca solo letras o números, sin espacios.')">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                            

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}" hidden>
                            <label for="type" class="col-md-4 control-label">Rol</label>

                            <div class="col-md-6">
                                <select id="roles" class="form-select form-select-lg" name="type">
                                    <option value="users" {{ old('type', $user->type) == 'users' ? 'selected' : '' }}>Usuario</option>
                                    <option value="waiters" {{ old('type', $user->type) == 'waiters' ? 'selected' : '' }}>Camarero</option>
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
                                <select id="activated" class="form-select form-select-lg" name="activated">
                                    <option value="1" {{ old('activated', $user->activated) == '1' ? 'selected' : '' }}>Activado</option>
                                    <option value="0" {{ old('activated', $user->activated) == '0' ? 'selected' : '' }}>Desactivado</option>
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
