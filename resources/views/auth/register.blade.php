<head>
    <link rel="stylesheet" href="{{ asset('css/addblade.css')}}">   
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-user" aria-hidden="true"></i> Registro</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="25" pattern="([A-zÀ-ž\s]){1,25}" oninvalid="this.setCustomValidity('Por favor, introduzca solo letras (admite nombre compuesto, mayúsculas y minúsculas).')" onchange="this.setCustomValidity('')" required autofocus>

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
                                <input id="surname1" type="text" class="form-control" name="surname1" value="{{ old('surname1') }}"maxlength="30" pattern="([A-zÀ-ž\s]){1,30}" oninvalid="setCustomValidity(this.willValidate?'':'Por favor introduzca solo letras.')" onchange="this.setCustomValidity('')" required>

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
                                <input id="surname2" type="text" class="form-control" name="surname2" value="{{ old('surname2') }}" maxlength="30" pattern="([A-zÀ-ž\s]){1,30}" oninvalid="setCustomValidity(this.willValidate?'':'Por favor introduzca solo letras.')" onchange="this.setCustomValidity('')" required>

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
                                <input id="telephone" type="tel" class="form-control" name="telephone" maxlength="9" value="{{ old('telephone') }}" placeholder="123012345" pattern="[0-9]{9}" oninvalid="setCustomValidity(this.willValidate?'':'Por favor introduzca solo números.')" onchange="this.setCustomValidity('')" required>

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
                                <input id="text" type="tel" class="form-control" name="address" value="{{ old('address') }}" maxlength="150" value="{{ old('address') }}" pattern="[A-Za-z0-9'\.\-\s\,]{1,150}" required>

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
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" maxlength="30" pattern="[A-Za-z0-9\-_\.]{1,30}" oninvalid="setCustomValidity(this.willValidate?'':'Por favor introduzca solo letras o números, sin espacios.')" required>

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
                                <input id="password" type="password" class="form-control" name="password" placeholder="Se requieren mínimo 6 caracteres" minlength="6" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" minlength="6" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Confirmar registro
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
