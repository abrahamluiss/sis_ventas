@extends ('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-6 col-xs-12">
			<h3>Nuevo Administrador</h3>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <p>Corrige los siguientes errores:</p>
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('admins.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">{{ __('DNI') }}</label><button type="button" id="reniec"
                        onclick="onClickReniec()" class="ml-2 btn btn-info btn-sm">Buscar RENIEC</button>

                    <input type="number"  name="dni" id="dni" class="form-control"
                        placeholder="{{ __('DNI') }}" value="{{ old('dni') }}" required>
                </div>
                <div class="form-group">
                    <label for="name">{{ __('Nombre Completo') }}</label>
                    <input type="text" onkeyup="allInCapitalLetters(this);" id="name" name="name" class="form-control"
                        placeholder="{{ __('Nombre Completo del Paciente') }}" required value="{{ old('name') }}">
                </div>
                <div class=" form-group">
                    <label for="email">{{ __('E-mail') }}</label>
                    <input type="text" name="email" class="form-control" placeholder="{{ __('E-mail') }}"
                        value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Contraseña') }}</label>
                    <input type="text" name="password" class="form-control" placeholder="{{ __('Contraseña') }}"
                        value="{{ Str::random(9) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
		</div>
	</div>
@endsection
